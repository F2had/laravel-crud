<?php

use App\Http\Controllers\ChartController;
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
use App\Http\Controllers\EnrollmentController;
use  App\Http\Controllers\UserController;
use  App\Http\Controllers\SessionController;

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');;




Route::get('register', [UserController::class, 'create'])->name('register')->middleware('guest');

Route::post('register', [UserController::class, 'store'])->middleware('guest');

Route::get('logout', [SessionController::class, 'logout'])->middleware('auth');


Route::post('login', [SessionController::class, 'login'])->middleware('guest');

Route::resource('student', StudentController::class)->middleware('auth');
Route::get('student/edit/{id}', [StudentController::class, 'edit'])->middleware('auth');

Route::get('course/edit/{id}', [CourseController::class, 'edit'])->middleware('auth');
Route::resource('course', CourseController::class)->middleware('auth');

Route::resource('enrollment', EnrollmentController::class)->middleware('auth');
Route::get('enrollment/showEnrollment/{id}', [EnrollmentController::class, 'showEnrollment'])->middleware('auth');


Route::resource('chart', ChartController::class)->middleware('auth');
