<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentCourse;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courses = Course::orderBy('name')->get();

        return view('enrollment.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::paginate(50);
        $students = Student::paginate(50);
        return view('enrollment.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'student' => ['required'],
            'course' => ['required'],
        ]);
        try {
            StudentCourse::create([
                'student_id' => $request->student,
                'course_id' => $request->course,
                'year' => date("Y"),
            ]);
        } catch (\Exception $e) {

            $error = $e->getMessage();
            return redirect('enrollment/create')->with('error', $error);
        }

        return redirect('enrollment')->with('message', 'Enrollment Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('enrollment.view', compact('student'));
    }

    public function showEnrollment($id)
    {
        $course = Course::find($id);
        $count = $course->students->count();
        $students = $course->students()->orderBy('name')->paginate(25);
        return view('enrollment.courseEnrollment', compact('course', 'students', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ddd($id);
    }
}
