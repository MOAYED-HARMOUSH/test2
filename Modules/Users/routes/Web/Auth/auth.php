<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\UserCrudController;
use Modules\Users\Http\Controllers\Auth\UserLoginController;
use Modules\Users\Http\Controllers\Auth\UserSignUpController;
use Modules\Users\Http\Controllers\Crud\UserCrudController as CrudUserCrudController;
use Modules\Users\Http\Controllers\ForgotPasswordController;
use Modules\Users\Http\Controllers\PasswordResetCodeController;
use Modules\Users\Http\Controllers\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/signup', [UserSignUpController::class, 'showSignupForm'])->name('signup.form');
Route::get('/forgotPassword', [UserSignUpController::class, 'forgotPassword'])->name('forgotPassword');


Route::post('/signup', [UserSignUpController::class, 'signup'])->name('signup.submit');

Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.submit');


Route::post('/add', [UserSignUpController::class, 'adduser'])->name('users.add');

Route::get('/showUers', [CrudUserCrudController::class, 'showUers'])->name('showUers');

Route::get('/dashboard', [CrudUserCrudController::class, 'dashboard'])->name('dashboard');

Route::get('/AllUsers', [CrudUserCrudController::class, 'AllUsers'])->name('AllUsers');


//
//1
Route::get('password/reset', [PasswordResetCodeController::class, 'showLinkRequestForm'])
->name('password.request');
 
//2
Route::post('/password/send-code', [PasswordResetCodeController::class, 'sendResetCode'])
    ->name('password.send.code');
//3
    Route::get('password/reset/{token}', [PasswordResetCodeController::class, 'showResetForm'])
    ->name('password.reset');
//4
Route::post('/password/reset', [PasswordResetCodeController::class, 'verifyCodeAndResetPassword'])
    ->name('password.reset.submit');

    Route::get('login/google', [UserLoginController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('login/google/callback', [UserLoginController::class, 'handleGoogleCallback']);