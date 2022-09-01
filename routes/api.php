<?php

use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;
use App\Http\Controllers\Api\v1\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\StudentController;

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

Route::prefix('auth')->group(function(){
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
    Route::group(['namespace' => 'Api\v1'], function () {
        Route::get('courses', [CourseController::class, 'all']);

        Route::post('students', [StudentController::class, 'create']);
        Route::get('students', [StudentController::class, 'all']);
        Route::get('students/{id}', [StudentController::class, 'find']);
        Route::put('students/{param}', [StudentController::class, 'edit']);
        Route::delete('students/{id}', [StudentController::class, 'delete']);
    });
});
