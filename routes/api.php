<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\studentController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Auth\AuthController;

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


//Route::get('students', [studentController::class, 'index']);
//Route::get('students/{id}', [studentController::class, 'show']);
//Route::post('students', [studentController::class, 'store']);
//Route::put('students/{id}', [studentController::class, 'update']);
//Route::delete('students/{id}', [studentController::class, 'destroy']);


Route::apiResource('student',studentController::class);
Route::apiResource('subject',SubjectController::class);


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('payload', [AuthController::class, 'payload']);
    Route::post('register', [AuthController::class, 'register']);
});
