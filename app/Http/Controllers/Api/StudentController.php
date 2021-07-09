<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

  public function index()
  {
    $students = Student::all();
    return response()->json(['students' => $students]);
  }




  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      "name" => ['required', 'string'],
      "email" => ['required', 'email', 'unique:students,email'],
      'department' => ['required', 'string'],
      'phone' => ['required']
    ]);


    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }

    $student = Student::create([
      "name" => $request->name,
      "email" => $request->email,
      "department" => $request->department,
      "phone" => $request->phone
    ]);
    return response()->json(['sucess' => $student]);
  }

  public function show($id)
  {
    $student = Student::find($id);
    return response()->json(['student' => $student]);
  }


  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      "name" => ['required', 'string'],
      "email" => ['required', 'email', 'unique:students,email'],
      'department' => ['required', 'string'],
      'phone' => ['required']
    ]);


    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 401);
    }
    $student = Student::where('id', $id)->update([
      "name" => $request->name,
      "email" => $request->email,
      "department" => $request->department,
      "phone" => $request->phone
    ]);
    return response()->json(['updateed' => $student]);
  }


  public function destroy($id)
  {
    $student = Student::destroy($id);
    return response()->json(['deleted' => $student]);
  }
}
