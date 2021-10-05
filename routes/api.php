<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('classes',  \App\Http\Controllers\Api\StudentClassController::class);
Route::apiResource('subjects', \App\Http\Controllers\Api\SubjectController::class);
Route::apiResource('sections', \App\Http\Controllers\Api\SectionController::class);
Route::apiResource('students', \App\Http\Controllers\Api\StudentController::class);


Route::group([
//    'middleware' => 'api',
    'prefix' => 'auth'
], function () {

    Route::post('login',   [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout',  [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me',      [\App\Http\Controllers\AuthController::class, 'me']);

    Route::post('register',      [\App\Http\Controllers\AuthController::class, 'register']);
});

