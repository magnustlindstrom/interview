<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $region = $request->input('region');
        if ($region){
            $schools = School::where('region_id', $region)->select('id','name')->get();
        } else {
            $schools = School::select('id','name')->get();
        }

        return $schools;
    }
}
