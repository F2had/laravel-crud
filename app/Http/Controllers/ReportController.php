<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class ReportController extends Controller
{

    public function index()
    {
        $projects = array('Student', 'tutorials');
        $reports = array('students', 'orders');

        return view('report.index', compact('projects', 'reports'));
    }
    public function studentsReport(Request $request)
    {
        $engine = App::make("getReporticoEngine");
        $engine->access_mode = "ONEPROJECT";
        $engine->initial_execute_mode = "MENU";
        $engine->initial_project = "Student";
        $engine->clear_reportico_session = true;
        return $engine->execute();
    }
}
