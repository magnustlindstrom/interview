<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AuthorModule\CoursePackage;
use App\Models\AuthorModule\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(CoursePackage $cp, Request $request){

        return response()->json([
            'error' => false,
            'data' => $cp->sections,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'course_package_id' => 'required|numeric',
            'color' => 'required|string',
        ]);

        $s = Section::create($validated);
        return response()->json([
            'error' => false,
            'data'  => $s,
        ]);
    }

    public function update(Request $request, Section $s)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'course_package_id' => 'nullable|numeric',
            'color' => 'nullable|string',
        ]);

        $s->update($validated);
        return response()->json([
            'error' => false,
            'data'  => $s,
        ]);
    }

    public function delete(Request $request, Section $s)
    {
        $s->delete();
        return response()->json([
            'error' => false,
            'data'  => 'Section was successfully deleted.',
        ]);
    }
}
