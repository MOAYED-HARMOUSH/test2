<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersControlle;
use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\UsersController;
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

Route::post('/register',[UsersController::class,'signUp'])->name('user.signUp');
Route::get('/test',[UsersController::class,'test'])->name('user.signUp');

