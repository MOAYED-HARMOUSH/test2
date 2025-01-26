<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\UserLoginController;
use Modules\Users\Http\Controllers\Auth\UsersController as AuthUsersController;
use Modules\Users\Http\Controllers\UsersController;

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

// Route::group([], function () {
//     Route::resource('users', UsersController::class)->names('users');
// });

Route::get('login/google', [UserLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [UserLoginController::class, 'handleGoogleCallback']);


Route::get('login/openid', [UserLoginController::class, 'redirectToOpenID'])->name('openid.login');
Route::get('login/openid/callback', [UserLoginController::class, 'handleOpenIDCallback']);