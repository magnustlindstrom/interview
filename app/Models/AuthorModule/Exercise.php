<?php

namespace App\Models\AuthorModule;

use App\Models\User;
use App\Scopes\ContentScope;
use App\Traits\ReviewableTrait;
use App\Traits\VisibilityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class Exercise extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;
    use VisibilityTrait;
    use ReviewableTrait;

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

//    protected $with = ['questions'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $appends = [
        'required_no_questions',
        'goal_grade_string',
        'grade_points_string',
        'seen_questions_no',
        'answered_questions_no',
        'solved_questions_no',
        'is_repeating'
    ];

    protected $fillable = [
        'name',
        'description',
        'e_points',
        'c_points',
        'a_points',
        'e_goal_grade_minimum',
        'd_goal_grade_minimum',
        'c_goal_grade_minimum',
        'b_goal_grade_minimum',
        'a_goal_grade_minimum',
        'duration_in_seconds',
        'learning_sequence_id',
        'solution_text'
    ];

    public function questions()
    {
        return $this->hasMany('App\Models\AuthorModule\Question');
    }

    public function getRequiredNoQuestionsAttribute()
    {
        $user = auth()->user();
        if( $user === null ) return null;
        else if(!$user->hasRole(User::ROLE_STUDENT)) return null;

        $studentClassId = app('student_class')->class_id;
        $class = $user
            ->class_info_private()
            ->where('class_id', $studentClassId )
            ->first();

        if( !$class ) return null;

        $goalGrade = $class->grade;
        if($goalGrade == 'none') return $goalGrade;

        $goalGradeString = "${goalGrade}_goal_grade_minimum";
        return $this->{$goalGradeString};
    }

    public function getSeenQuestionsAttribute()
    {
        $user = auth()->user();
        if( $user === null) return collect([]);
        elseif( !$user->hasRole( User::ROLE_STUDENT )) return collect([]);

        return \DB::table('student_exercises')
            ->select('question_id', 'correct', 'answered')
            ->where('student_id', $user->id)
            ->where('exercise_id', $this->id)
            ->orderBy('updated_at', 'ASC')
            ->get();
    }
    public function getAnsweredQuestionsAttribute()
    {
        return $this->seenQuestions->where('answered', true);
    }
    public function getSolvedQuestionsAttribute()
    {
        return $this->answeredQuestions->where('correct', true);
    }

    public function getSeenQuestionsNoAttribute(){
        return $this->seenQuestions->count();
    }
    public function getAnsweredQuestionsNoAttribute(){
        return $this->answeredQuestions->count();
    }
    public function getSolvedQuestionsNoAttribute(){
        return $this->solvedQuestions->count();
    }

    public function learningSequence()
    {
        return $this->belongsTo('App\Models\AuthorModule\LearningSequence');
    }

    public function getGoalGradeStringAttribute(){
        $goalGrades = ['e', 'd', 'c', 'b', 'a'];

        foreach ($goalGrades as $key => $g){
            $goalGradeString = "${g}_goal_grade_minimum";
            $val = $this->{$goalGradeString};

            if (!$val) unset($goalGrades[$key]);
        }

        return strtoupper(implode(" ", $goalGrades));
    }

    public function getGradePointsStringAttribute(){
        $gradePoints = ['e', 'c', 'a'];
        $gradePointsArray = array();

        foreach ($gradePoints as $key => $g){
            $gradePointString = "${g}_points";
            $gradePointsArray[] = $this->{$gradePointString};
        }

        return implode("/", $gradePointsArray);
    }

    public function getIsRepeatingAttribute(){
        return $this->solvedQuestionsNo >= $this->requiredNoQuestions;
    }

    public function getIsCompletedAttribute(){
        return $this->isRepeating;
    }
}
