<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//crud de ruta creada con su respectivo middleware de auth y rate-limit bien catalino
Route::middleware(['auth:sanctum', 'verified', 'throttle:general-rate'])->group(function () {
    Route::apiResource('tasks', TaskController::class);

    Route::patch('/tasks/{task}/complete/toggle', [TaskController::class, 'complete']);
});


Route::controller(AuthController::class)->group(function () {
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware('signed');

    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
    ->middleware(['throttle:1,1', 'auth:sanctum']);
});