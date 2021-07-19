<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('student.create');
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
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:students,email'],
            'phone' => ['required'],
            'department' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'nationality' => ['required'],
            'state' => ['required']
        ]);

        Student::create($request->all());

        return redirect('student')->with('message', 'Student Added!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);

        return view('student.edit', compact('student'));
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


        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'department' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'nationality' => ['required'],
            'state' => ['required']
        ]);



        Student::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'address' => $request->address,
            'country' => $request->country,
            'nationality' => $request->nationality,
            'state' => $request->state
        ]);

        return redirect('student')->with('message', 'Student updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::destroy($id);

        return redirect()->back()->with('message', 'Student deleted!');
    }
}
