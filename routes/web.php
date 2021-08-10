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
use  App\Http\Controllers\SurveyController;
use  App\Http\Controllers\UserController;
use  App\Http\Controllers\SessionController;

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');;




Route::get('register', [UserController::class, 'create'])->name('register')->middleware('guest');

Route::post('register', [UserController::class, 'store'])->middleware('guest');

Route::get('logout', [SessionController::class, 'logout'])->middleware('auth');


Route::post('login', [SessionController::class, 'login'])->middleware('guest');

Route::get('student/filter', [StudentController::class, 'filter'])->middleware('auth');
Route::resource('student', StudentController::class)->middleware('auth');
Route::get('student/edit/{id}', [StudentController::class, 'edit'])->middleware('auth');

Route::get('course/edit/{id}', [CourseController::class, 'edit'])->middleware('auth');
Route::resource('course', CourseController::class)->middleware('auth');

Route::resource('enrollment', EnrollmentController::class)->middleware('auth');
Route::get('enrollment/showEnrollment/{id}', [EnrollmentController::class, 'showEnrollment'])->middleware('auth');


Route::resource('chart', ChartController::class)->middleware('auth');




Route::get('survey/show/{id}', [SurveyController::class, 'show'])->middleware('auth');

Route::get('survey/edit/{id}', [SurveyController::class, 'edit'])->middleware('auth');


Route::delete('survey/question-delete/{id}', [SurveyController::class, 'deleteQuestion'])->middleware('auth');
Route::get('survey/update/question/{id}', [SurveyController::class, 'updateQuestionView'])->middleware('auth');
Route::put('survey/update/question/{id}', [SurveyController::class, 'updateQuestion'])->middleware('auth');
Route::post('survey/add/questions', [SurveyController::class, 'addQuestions'])->middleware('auth');
Route::post('survey/isopen-update/{id}', [SurveyController::class, 'updateIsOpen'])->middleware('auth');

Route::resource('survey', SurveyController::class)->name('get', 'survey')->middleware('auth');
