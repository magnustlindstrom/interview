<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AuthorModule\CoursePackage;
use Illuminate\Http\Request;

class CoursePackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $data = CoursePackage::all();

        return response()->json([
            'error' => false,
            'data'  => $data,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'course_id' => 'required|numeric',
        ]);

        $cp = CoursePackage::create($validated);
        return response()->json([
            'error' => false,
            'data'  => $cp,
        ]);
    }

    public function update(Request $request, CoursePackage $cp)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'course_id' => 'nullable|numeric',
        ]);

        $cp->update($validated);
        return response()->json([
            'error' => false,
            'data'  => $cp
        ]);
    }

    public function delete(Request $request, CoursePackage $cp)
    {
        $cp->delete();
        return response()->json([
            'error' => false,
            'data'  => 'Course package was successfully deleted',
        ]);
    }
}
