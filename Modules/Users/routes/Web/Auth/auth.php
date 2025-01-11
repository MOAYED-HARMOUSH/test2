<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\UserLoginController;
use Modules\Users\Http\Controllers\Auth\UserSignUpController;

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
Route::post('/signup', [UserSignUpController::class, 'signup'])->name('signup.submit');

Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserLoginController::class, 'login'])->name('login.submit');
