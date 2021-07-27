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

        $courses = Course::all();

        return view('chart.index', compact('courses'));
    }


    public function show(Request $request, $id)
    {
        $by = $request->query('by');
        $course = Course::find($id);
        $course->count_by = $course->students->groupBy($by)->map->count();
        $course->by = $by;
        return view('chart.chart', compact('course'));
    }
}
