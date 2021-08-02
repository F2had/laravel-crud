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
        $age = $request->age;
        $year = $request->year;
        $by = $request->by;
        $courseID = $request->course;

        if ($age && $year) {
            $course = Course::where('id', $courseID)->with(['students' => function ($query) use ($by, $age, $year) {
                $query->wherePivot('year', $year)->where('age', '=', $age)->select($by);
            }])->first();
        } else if ($age) {

            $course = Course::find($courseID)->with(['students' => function ($query) use ($by, $age) {
                $query->where('age', $age)->select($by);
            }])->first();
        } else if ($year) {
            $course = Course::where('id', $courseID)->with(['students' => function ($query) use ($by, $year) {
                $query->wherePivot('year', $year)->select($by);
            }])->first();
        } else {
            $course = Course::find($courseID)->with(['students' => function ($query) use ($by) {
                $query->select($by);
            }])->first();
        }


        $course->count_by = $course->students->groupBy($by)->map->count();
        $course->by = $by;
        return response()->json($course);
    }
}
