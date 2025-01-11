<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersControlle;
use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\UserLoginController;
use Modules\Users\Http\Controllers\Auth\UserSignUpController;
use Modules\Users\Http\Controllers\Auth\UsersSignUpController;
use Modules\Users\Http\Controllers\BaseController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::post('/register',[UserSignUpController::class,'signUp'])->name('user.signUp');
 
Route::post('/login',[UserLoginController::class,'login'])->name('user.login');
