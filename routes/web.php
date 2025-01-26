<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\ForgotPasswordController;
use Modules\Users\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

