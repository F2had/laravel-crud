<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::whereHas('students')->get();
        $courses->map(function ($course) {
            //Count each student country for a subject
            $course->count_by_country = $course->students->groupBy('country')->map->count();
            //Count State
            $course->count_by_state = $course->students->groupBy('state')->map->count();
            //Count Department
            $course->count_by_department = $course->students->groupBy('department')->map->count();
            return $course;
        });
        ddd($courses);
        return view('charts');
    }

}
