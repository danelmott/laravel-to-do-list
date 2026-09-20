<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// crud de ruta creada con su respectivo middleware de auth y rate-limit
Route::middleware(['auth:sanctum', 'throttle:general-rate'])->group(function () {
    Route::apiResource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/complete/toggle', [TaskController::class, 'complete']);
});


Route::controller(AuthController::class)->group(function () {
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware(['throttle:1,1', 'auth:sanctum']);
});
