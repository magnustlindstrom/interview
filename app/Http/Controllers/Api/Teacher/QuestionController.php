<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AuthorModule\CoursePackage;
use App\Models\AuthorModule\Section;
use App\Models\AuthorModule\Category;
use App\Models\AuthorModule\Question;
use App\Models\AuthorModule\Topic;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(CoursePackage $cp, Section $s, Category $c, Topic $t){
        return response()->json([
            'error' => false,
            'data'  => $t->questions
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'question_content' => 'required|string',
            'topic_id' => 'required|numeric',
            'question_type' => 'required|numeric',
            'answer_type' => 'required|numeric',
        ]);

        $q = Question::create($validated);
        return response()->json([
            'error' => false,
            'data'  => $q
        ]);
    }

    public function update(Request $request, Question $q)
    {
        $validated = $request->validate([
            'question_content' => 'nullable|string',
            'topic_id' => 'nullable|numeric',
            'question_type' => 'nullable|numeric',
            'answer_type' => 'nullable|numeric',
        ]);

        $q->update($validated);
        return response()->json([
            'error' => false,
            'data'  => $q
        ]);
    }

    public function delete(Request $request, Question $q)
    {
        $q->delete();
        return response()->json([
            'error' => false,
            'data'  => 'Question was successfully deleted.',
        ]);
    }
}
