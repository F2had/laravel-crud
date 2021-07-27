<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students/filter', [StudentController::class, 'filter'])->middleware('auth:api');
Route::apiResource('students', StudentController::class)->middleware('auth:api');

Route::post('register', 'App\Http\Controllers\Api\PassportAuthController@register');

Route::post('login', [PassportAuthController::class, 'login'])->name('login');
