<?php

namespace App\Http\Controllers;

use App\Models\AuthorModule\Exercise;
use App\Models\AuthorModule\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearnController extends Controller
{
    // TODO: optimize the functions and introduce models
    public function fetchQuestion(Request $request, $exerciseId = null)
    {
        $exercise = Exercise::find($request->input('exercise'));

        if($exercise->isRepeating) return abort(403);
        $question = $this->fetchQuestionForLearn($exercise);
        return $this->transformQuestionData($question);
    }

    public function fetchRepeatQuestions(Exercise $exercise){
        if(!$exercise->isRepeating) return abort(403);

        $questionPool = $this->getAnswerQuestionIds($exercise);
        $questions = Question::whereIn('id', $questionPool)->get();
        $questions->transform(fn($q) => $this->transformQuestionData($q));

        return $questions;
    }

    private function fetchQuestionForLearn( $exercise ){
        $unansweredQuestion = DB::table('student_exercises')
            ->where('student_id', auth()->user()->id)
            ->where('exercise_id', $exercise->id)
            ->where('answered', false)
            ->first();

        if ($unansweredQuestion) {
            $question = Question::find($unansweredQuestion->question_id);
            return $this->transformQuestionData($question);
        }

        $availableQuestions = Question::query()
            ->where('exercise_id', $exercise->id)
            ->whereNotIn('id', $this->getAnswerQuestionIds( $exercise ))
            ->get();

        $question = $availableQuestions->count() > 0 ?
            $availableQuestions->random() : $this->reuseOldQuestion($exercise);

        $this->storeStartNewExercise($exercise, $question);

        return $this->transformQuestionData($question);
    }

    private function reuseOldQuestion($exercise)
    {
        $reuseCount = DB::table('student_exercises')
            ->selectRaw('question_id, count(*) as count')
            ->where('student_id', auth()->user()->id)
            ->where('exercise_id', $exercise->id)
            ->where('answered', true)
            ->groupBy('question_id')
            ->get();

        $lowest = $reuseCount->min('count');
        $reusableQuestions = $reuseCount->where('count', $lowest);

        return Question::find($reusableQuestions->pluck('question_id')->random());
    }
    private function getAnswerQuestionIds($exercise)
    {
        return DB::table('student_exercises')
            ->where('student_id', auth()->user()->id)
            ->where('exercise_id', $exercise->id)
            ->where('answered', true)
            ->pluck('question_id');
    }

    public function checkAnswers(Request $request)
    {
        $questionId = $request->input('question');
        $answers = $request->input('answers') ?? [];

        $question = Question::find($questionId);

        if ($question->answer_type == 2) $checkedAnswers = $this->checkAnswersForMultipleChoiceQuestion($question, $answers);
        elseif ($question->answer_type == 1) $checkedAnswers = $this->checkAnswersForNumberQuestion($question, $answers);

        $exercise = DB::table('student_exercises')
            ->where([
                'student_id' => auth()->user()->id,
                'question_id' => $questionId,
            ])
            ->orderByDesc('created_at')
            ->first();

        $is_correct = collect($checkedAnswers)
            ->whereNotNull('is_correct')
            ->reduce(fn($res, $a) => $res && $a['is_correct'], true);

        if(!$question->exercise->isRepeating)
        {
            $this->storeAnsweredExercise($exercise, $questionId, $is_correct);
            $this->storeAnswers($answers, $exercise);
        }

        $exerciseVideo = $question->exercise->similar_solution ?
            \Storage::url('uploads/' . $question->exercise->similar_solution) : null;

        $response = [
            'skipped' => empty($answers),
            'question' => $question->question_content,
            'solution' => $question->solution_text,
            'video' => $exerciseVideo,
            'answerTable' => $checkedAnswers,
            'correct' => $is_correct,
            'exerciseBlock' => $question->exercise,
        ];

        return response($response);
    }

    public function getExerciseBlock(Exercise $exercise)
    {
        return [
            'questions' => $exercise->solvedQuestions,
            'number' => $exercise->solvedQuestionsNo,
        ];
    }

    private function storeStartNewExercise($exercise, $question)
    {
        DB::table('student_exercises')
            ->insert([
                'student_id' => auth()->user()->id,
                'exercise_id' => $exercise->id,
                'question_id' => $question->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }

    private function storeAnsweredExercise($studentExercise, $question, $isCorrect)
    {
        $exercise = Exercise::find($studentExercise->exercise_id);

        DB::table('student_exercises')
            ->where('id', $studentExercise->id)
            ->update([
                'answered' => true,
                'correct' => $isCorrect,
                'updated_at' => now(),
            ]);

        if($exercise->isCompleted)
        {
            DB::table('review_current')->insert([
                'student_id' => auth()->id(),
                'exercise_block_id' => $exercise->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function storeAnswers($answers, $exercise)
    {
        $typeOfQuestion = Question::find($exercise->question_id)->answer_type == 1 ? 'number' : 'multiple-choice';

        if($typeOfQuestion == 'multiple-choice')
        {
            $answers = collect($answers)
                ->filter(fn($a) => $a['selected'])
                ->map(fn($a) => $a['id'])
                ->toArray();
        }
        elseif ($typeOfQuestion == 'number')
        {
            $answers = $answers;
        }

        foreach ($answers as $answer) {
            DB::table('student_answers')
                ->insert([
                    'student_id' => auth()->user()->id,
                    'student_exercise_id' => $exercise->id,
                    'answer' => $answer,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
    }

    private function transformQuestionData($question)
    {
        if (Question::$answerTypes [$question->answer_type ] !== Question::ANSWER_TYPE_MC ) {
            $filteredQuestions = $question
                ->answers()
                ->orderBy('order_column')
                ->get()
                ->map(fn($a) => $a->makeHidden(['answer_content', 'id', 'question_id']));
            $question->unsetRelation('answers');
            $question->setAttribute('answers', $filteredQuestions);
        }
        else{
            $randomOrderAnswers = $question->answers()->inRandomOrder()->get();
            $question->unsetRelation('answers');
            $question->setAttribute('answers', $randomOrderAnswers);
        }
        return $question->makeHidden(['solution_text']);
    }

    // === Check Answers
    private function checkAnswersForMultipleChoiceQuestion($question, $givenAnswers)
    {
        $answers = $question->answers;
        $answerTable = [];
        $givenAnswers = collect($givenAnswers)->keyBy('id');

        foreach($answers as $answer)
        {
            $givenAnswer = $givenAnswers->get($answer->id) ?? ['selected' => false];
            $is_correct = null;

            if ($answer->is_correct && $givenAnswer['selected']) $is_correct = true;
            elseif ($givenAnswer['selected'] xor $answer->is_correct) $is_correct = false;
            $answerTable[] = [
                'id' => $answer->id,
                'content' => $answer->answer_content,
                'selected' => $givenAnswer['selected'],
                'correct' => $answer->is_correct,
                'is_correct' => $is_correct];
            $givenAnswers->forget($answer->id);
        }
//        foreach ($givenAnswers as $givenAnswer) {
//            $answer = $answers->find($givenAnswer['id']);
//            if ($answer === null) throw new \Exception('Interesting, reach us at talent@pluggamatte.se!');
//
//            $is_correct = null;
//            if ($answer->is_correct && $givenAnswer['selected']) $is_correct = true;
//            elseif ($givenAnswer['selected'] xor $answer->is_correct) $is_correct = false;
//
//            $answerTable[] = [
//                'id' => $answer->id,
//                'content' => $answer->answer_content,
//                'selected' => $givenAnswer['selected'],
//                'correct' => $answer->is_correct,
//                'is_correct' => $is_correct];
//            $answers->forget($answer->id);
//        }
        return $answerTable;
    }

    private function checkAnswersForNumberQuestion($question, $givenAnswers)
    {
        $ordered = (bool)$question->order_of_answers_matter;
        $exact = (bool)$question->exact_answer;

        $correctAnswers = $question
            ->answers()
            ->where('is_correct', true)
            ->orderBy('order_column')
            ->get()
            ->map(fn($a) => [
                'content' => $a->answer_content,
                'prefix' => $a->prefix,
                'suffix' => $a->suffix,
            ]);

        [$new_givenAnswers, $new_correctAnswers] = collect([$givenAnswers, $correctAnswers])
            ->map(function($answersGroup) use($exact) {
                return collect($answersGroup)->map(function ($v) use ($exact) {
                    $answerContent = $v['content'] ?? $v;
                    $replaced = str_replace(',', '.', $answerContent);
                    // TODO: switch 'eval' for something safer
                    $evaluated = eval("return $replaced;");
                    if(!$exact) $replaced = $evaluated;
                    return [
                        'eval' => $replaced,
                        'actual' => $answerContent,
                        'prefix' => $v['prefix'] ?? null,
                        'suffix' => $v['suffix'] ?? null,
                        'forcedEval' => $evaluated,
                    ];
                });
            });

        if ($ordered) {
            return $this->retrieveOrderedNumberQuestionAnswerTable($new_givenAnswers, $new_correctAnswers);
        }
        return $this->retrieveUnorderedNumberQuestionAnswerTable($new_givenAnswers, $new_correctAnswers);
    }

    private function retrieveOrderedNumberQuestionAnswerTable($givenAnswers, $correctAnswers)
    {
        $answerTable = [];
        for ($c = 0; $c < $correctAnswers->count(); $c++) {
            $given = $givenAnswers->get($c);
            $correct = $correctAnswers->get($c);
            $is_correct = ($given['eval'] ?? null) == ($correct['eval'] ?? null);

            $answerTable[] = [
                'given' => $given['actual'] ?? null,
                'correct' => $correct['actual'] ?? null,
                'is_correct' => $is_correct,
                'prefix' => $correct['prefix'] ?? null,
                'suffix' => $correct['suffix'] ?? null,
            ];
        }

        for ($c = $correctAnswers->count(); $c < $givenAnswers->count(); $c++) {
            $given = $givenAnswers->get($c);
            $answerTable[] = ['given' => $given['actual'] ?? null, 'correct' => null, 'is_correct' => false];
        }

        return $answerTable;
    }

    private function retrieveUnorderedNumberQuestionAnswerTable($givenAnswers, $correctAnswers)
    {
        $answerTable = [];

        foreach ($givenAnswers as $answer) {
            $answerTableRow = ['given' => $answer['actual'], 'correct' => null, 'is_correct' => null];

            $index = $correctAnswers->mapWithKeys(fn($a, $k) => [$k => $a['eval']])->search($answer['eval']);
            $index2 = $correctAnswers->mapWithKeys(fn($a, $k) => [$k => $a['forcedEval']])->search($answer['forcedEval']);
            $is_correct = false;

            // NOTE: using index2 to align cases like 0,34 and 34/100 even when the question is exact
            if ($index !== false) {
                $is_correct = true;
                $answerTableRow['correct'] = $correctAnswers->get($index)['actual'];
                $correctAnswers->forget($index);
            }
            else if($index2 !== false) {
                $answerTableRow['correct'] = $correctAnswers->get($index2)['actual'];
                $correctAnswers->forget($index2);
            }
            $answerTableRow['is_correct'] = $is_correct;
            $answerTable[] = $answerTableRow;
        }

        $walkCount = 0;
        $givenAnswersCount = count($answerTable);
        foreach ($correctAnswers->toArray() as $a) {
            while ($walkCount < $givenAnswersCount) {
                $currentWalkCount = $walkCount;
                $walkCount++;
                if ($answerTable[$currentWalkCount]['correct'] === null) {
                    $answerTable[$currentWalkCount]['correct'] = $a['actual'];
                    continue 2;
                }
            }
            $answerTable[] = ['given' => null, 'correct' => $a['actual'], 'is_correct' => false];
            $walkCount++;
        }
        return $answerTable;
    }
}
