<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use  App\Http\Controllers\StudentController;
use  App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('login');
});



Route::resource('student', StudentController::class);

Route::resource('course', CourseController::class);