<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChannelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\TaskController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API-Routen für Channels
Route::apiResource('channels', ChannelController::class);
Route::post('/users/register', [AuthController::class, 'register']);
Route::post('/users/login', [AuthController::class, 'login']);
Route::apiResource('tasks', TaskController::class);
Route::get('/users', [AuthController::class, 'index']);
