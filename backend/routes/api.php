<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:sanctum')->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('forgot/password', 'forgot');
        Route::post('account/verification', 'verification');
        Route::post('password/reset', 'reset');
    });
});

Route::middleware('auth:sanctum')->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::post('account/verify', 'verify');
        Route::post('logout', 'logout');
        Route::post('user', 'getUser');
    });
});

