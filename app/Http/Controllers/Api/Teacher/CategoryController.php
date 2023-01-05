<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AuthorModule\Category;
use App\Models\AuthorModule\CoursePackage;
use App\Models\AuthorModule\Section;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(CoursePackage $cp, Section $s, Request $request){
        return response()->json([
            'error' => false,
            'data' => $s->categories,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'section_id' => 'required|numeric',
            'code_letter' => 'required|string',
        ]);

        $c = Category::create($validated);
        return response()->json([
            'error' => false,
            'data'  => $c,
        ]);
    }

    public function update(Request $request, Category $c)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'section_id' => 'nullable|numeric',
            'code_letter' => 'nullable|string',
        ]);

        $c->update($validated);

        return response()->json([
            'error' => false,
            'data'  => $c
        ]);
    }

    public function delete(Request $request, Category $c)
    {
        $c->delete();

        return response()->json([
            'error' => false,
            'data'  => 'Category was successfully deleted.'
        ]);
    }
}
