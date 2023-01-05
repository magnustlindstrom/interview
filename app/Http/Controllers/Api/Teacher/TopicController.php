<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AuthorModule\Category;
use App\Models\AuthorModule\CoursePackage;
use App\Models\AuthorModule\Section;
use App\Models\AuthorModule\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(CoursePackage $cp, Section $s, Category $c){
        return response()->json([
            'error' => false,
            'data' => $c->topics
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'theory_content' => 'nullable|string',
            'theory_video' => 'nullable|string'
        ]);

        $t = Topic::create($validated);
        return response()->json([
            'error' => false,
            'data'  => $t
        ]);
    }

    public function update(Request $request, Topic $t)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'category_id' => 'nullable|numeric',
            'theory_content' => 'nullable|string',
            'theory_video' => 'nullable|string'
        ]);

        $t->update($validated);
        return response()->json([
            'error' => false,
            'data'  => $t,
        ]);
    }

    public function delete(Request $request, Topic $t)
    {
        $t->delete();
        return response()->json([
            'error' => false,
            'data'  => 'Topic was successfully deleted.',
        ]);
    }
}
