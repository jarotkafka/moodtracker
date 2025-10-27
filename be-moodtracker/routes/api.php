<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\LifehubController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route API resource
Route::apiResource('todos', TodoController::class);
Route::apiResource('lifehubs', LifehubController::class);
