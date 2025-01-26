<?php

use App\Http\Controllers\RolesAndPermissionsController;
use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\UsersController;
use Modules\Users\Http\Controllers\PasswordResetCodeController;

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

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('users', UsersController::class)->names('users');
// });

Route::get('/setup_roles_permissions', [RolesAndPermissionsController::class, 'setupRolesAndPermissions'])
    ->name('setup.roles.permissions');

    Route::post('/passwordSendCode', [PasswordResetCodeController::class, 'WsendCode']);

    Route::post('/passwordReset', [PasswordResetCodeController::class, 'WresetPassword']);