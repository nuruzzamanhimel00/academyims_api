<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PartnersInfoController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 //token generate
 Route::post('token-generage', [AuthController::class, 'tokenGenerate']);

 //personal info create
 Route::apiResource('partner-info', PartnersInfoController::class);
 Route::middleware('auth:api')->group( function () {
    Route::get('users-get', [AuthController::class,'getUsers']);
});
