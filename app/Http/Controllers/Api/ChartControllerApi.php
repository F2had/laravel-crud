<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class ChartControllerApi extends Controller
{
    function getData(Request $request)
    {

        // $course = Course::find($courseID);
        // $course->count_by = $course->students->groupBy($by)->map->count();
        $by = $request->by;
        $courseID = $request->course;

        $course = Course::find($courseID)->with(['students' => function ($query) use ($by) {
            $query->select($by);
        }])->first();
        $course->count_by = $course->students->groupBy($by)->map->count();
        $course->by = $by;
        return response()->json($course);
    }
}
