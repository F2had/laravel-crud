<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class ReportController extends Controller
{

    public function index()
    {
        $ages = Student::distinct()->select('age')->get();
        $departments = Student::distinct()->select('department')->get();
        $countries = Student::distinct()->select('country')->orderBy('country')->get();
        return view('report.index', compact('ages', 'departments', 'countries'));
    }
    public function studentsReport(Request $request)
    {
        $filter = array_only($request->all(), ['age', 'department', 'country']);

        $title = 'Students Report'; // Report title

        $meta = [ // For displaying filters description on header
            'Company' => 'Name'
        ];



        $queryBuilder = Student::select(['id', 'name', 'age', 'department', 'country'])
            ->where($filter)
            ->limit(500);
        $columns = [ // Set Column to be displayed
            'ID', 
            'Name' => 'name',
            'Age', 
            'Department',
            'Country',
            // 'Status' => function ($result) { // You can do if statement or any action do you want inside this closure
            //     return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            // }
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return \PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->showTotal([
                'Age' => 'point'
            ])
            // ->editColumns(['Total Balance', 'Status'], [ // Mass edit column
            //     'class' => 'right bold'
            // ])
            // ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            //     'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            // ])
            ->download('Sutdent Report'); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
}
