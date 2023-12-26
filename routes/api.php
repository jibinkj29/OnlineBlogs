<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;

// Authentication routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes that require authentication
Route::middleware('auth:api')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index']);
});


