<?php

use App\Http\Controllers\Auth\AccountVerification;
use App\Http\Controllers\Auth\AccountVerificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordController::class, 'forgot'])
        ->name('forgot.password');

    Route::post('forgot-password', [PasswordController::class, 'forgotCode'])
        ->name('forgot.password');

    Route::get('reset-password/{code}/{email}', [PasswordController::class, 'reset'])
        ->name('password.reset');

    Route::post('reset-password', [PasswordController::class, 'store'])
        ->name('password.store');
});


Route::get('verify/code/{hash}', [AccountVerificationController::class, 'sendCode'])
    ->name('send.code');

Route::get('verify/account/{hash}', [AccountVerificationController::class, 'verifyAccount'])
    ->name('verifyAccount');

Route::post('verification/account', [AccountVerificationController::class, 'verification'])
    ->name('verification.account');

Route::middleware(['auth', 'verify'])->group(function () {
    Route::get('forgot/password', [ConfirmablePasswordController::class, 'forgot'])
        ->name('forgot.password');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
