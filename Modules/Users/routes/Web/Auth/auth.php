<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\UserCrudController;
use Modules\Users\Http\Controllers\Auth\UserLoginController;
use Modules\Users\Http\Controllers\Auth\UserSignUpController;
use Modules\Users\Http\Controllers\Crud\UserCrudController as CrudUserCrudController;
use Modules\Users\Http\Controllers\ForgotPasswordController;
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

// routes/web.php
// Route::get('/forget-password', [UserSignUpController::class, 'showForgetPasswordChoice'])->name('password.reset.choice.form');
// Route::post('/forget-password', [UserSignUpController::class, 'handleForgetPasswordChoice'])->name('password.reset.choice');
// Route::get('/reset-password/{token}', [UserSignUpController::class, 'showResetPasswordForm'])->name('password.reset.form');

// Route::post('/reset-password', [UserSignUpController::class, 'updatePassword'])->name('password.update');


