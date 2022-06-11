<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\StudentController;

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

Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);


Route::group(['middleware' => 'api'], function ($router) {
    Route::get('/students/{string}', [StudentController::class, 'globalSearch']);    
    Route::post('/student', [StudentController::class, 'store']);    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
