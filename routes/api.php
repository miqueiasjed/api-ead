<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\StudentController;
use App\Http\Controllers\Api\LoginController;


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

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});



Route::group(['prefix' => 'v1'], function(){
    Route::group(['namespace' => 'Api\v1'], function () {
        Route::get('courses', [CourseController::class, 'all']);
        Route::post('courses', [CourseController::class, 'create']);
        Route::get('courses/{id}', [CourseController::class, 'find']);
        Route::put('courses/{param}', [CourseController::class, 'edit']);
        Route::delete('courses/{id}', [CourseController::class, 'delete']);

        Route::post('students', [StudentController::class, 'create']);
        Route::get('students', [StudentController::class, 'all']);
        Route::get('students/{id}', [StudentController::class, 'find']);
        Route::put('students/{param}', [StudentController::class, 'edit']);
        Route::delete('students/{id}', [StudentController::class, 'delete']);
    });
});
