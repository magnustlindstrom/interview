<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AuthorModule\Answer;
use App\Models\AuthorModule\CoursePackage;
use App\Models\AuthorModule\Section;
use App\Models\AuthorModule\Category;
use App\Models\AuthorModule\Question;
use App\Models\AuthorModule\Topic;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(CoursePackage $cp, Section $s, Category $c, Topic $t, Question $q){
        return response()->json([
            'error' => false,
            'data' => $q->answers
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'answer_content' => 'required|string',
            'question_id' => 'required|numeric',
            'is_correct' => 'required|boolean'
        ]);

        $a = Answer::create($validated);
        return response()->json([
            'error' => false,
            'data'  => $a
        ]);
    }

    public function update(Request $request, Answer $a)
    {
        $validated = $request->validate([
            'answer_content' => 'nullable|string',
            'question_id' => 'nullable|numeric',
            'is_correct' => 'nullable|boolean'
        ]);

        $a->update($validated);
        return response()->json([
            'error' => false,
            'data'  => $a,
        ]);
    }

    public function delete(Request $request, Answer $a)
    {
        $a->delete();
        return response()->json([
            'error' => false,
            'data'  => 'Answer was successfully deleted.'
        ]);
    }
}
