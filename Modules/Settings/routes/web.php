<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\Authentication\AuthenticationController;
use Modules\Settings\Http\Controllers\Country\CountryController as CountryCountryController;
use Modules\Settings\Http\Controllers\Currency\CurrencyController;
use Modules\Settings\Http\Controllers\Financial\FinancialController;
use Modules\Settings\Http\Controllers\SettingsController;

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
//     Route::resource('settings', SettingsController::class)->names('settings');
// });

Route::prefix('settings/countries')->group(function () {
    Route::get('/', [CountryCountryController::class, 'index'])->name('settings.countries.index'); // عرض قائمة الدول
    Route::post('/', [CountryCountryController::class, 'store'])->name('settings.countries.store'); // إضافة دولة جديدة
    Route::put('/{id}', [CountryCountryController::class, 'update'])->name('settings.countries.update'); // تعديل دولة
    Route::delete('/{id}', [CountryCountryController::class, 'destroy'])->name('settings.countries.destroy'); // حذف دولة
});

Route::prefix('settings/currencies')->group(function () {
    Route::get('/', [CurrencyController::class, 'index'])->name('settings.currencies.index');
    Route::post('/', [CurrencyController::class, 'store'])->name('settings.currencies.store');
    Route::put('/{id}', [CurrencyController::class, 'update'])->name('settings.currencies.update');
    Route::delete('/{id}', [CurrencyController::class, 'destroy'])->name('settings.currencies.destroy');
});

Route::prefix('settings')->group(function () {
    Route::get('/financial', [FinancialController::class, 'showFinancialSettings'])->name('settings.financial');
    Route::post('/financial/currency/save', [FinancialController::class, 'saveCurrencySettings'])->name('settings.currency.save');
    Route::post('/financial/tax/save', [FinancialController::class, 'saveTaxSettings'])->name('settings.tax.save');
    Route::post('/financial/gateway/save', [FinancialController::class, 'saveGatewaySettings'])->name('settings.gateway.save');
    Route::post('/financial/gateway/test', [FinancialController::class, 'testPaymentGateway'])->name('settings.gateway.test');
    Route::post('/financial/invoice/save', [FinancialController::class, 'saveInvoiceSettings'])->name('settings.invoice.save');
    Route::post('/financial/policy/save', [FinancialController::class, 'savePolicySettings'])->name('settings.policy.save');
    Route::get('/financial/fetch', [FinancialController::class, 'fetchFinancialSettings'])->name('settings.financial.fetch'); // هذا الرابط كان ناقصًا
});

Route::prefix('settings/authentication')->name('settings.authentication.')->group(function () {

    // General Authentication Settings
    Route::get('/general', [AuthenticationController::class, 'showGeneralSettings'])
        ->name('general');
    Route::post('/general/save', [AuthenticationController::class, 'saveGeneralSettings'])
        ->name('general.save');

    // Authentication Mechanisms
    Route::get('/mechanisms', [AuthenticationController::class, 'showMechanisms'])
        ->name('mechanisms');
    Route::post('/mechanisms/save', [AuthenticationController::class, 'saveMechanisms'])
        ->name('mechanisms.save');
    Route::get('/mechanisms/test', [AuthenticationController::class, 'testMechanisms'])
        ->name('mechanisms.test');

    // Verification Methods
    Route::get('/verification', [AuthenticationController::class, 'showVerificationSettings'])
        ->name('verification');
    Route::post('/verification/save', [AuthenticationController::class, 'saveVerificationSettings'])
        ->name('verification.save');

    // SSO Settings
    Route::get('/sso', [AuthenticationController::class, 'showSSOSettings'])
        ->name('sso');
    Route::post('/sso/save', [AuthenticationController::class, 'saveSSOSettings'])
        ->name('sso.save');
    Route::get('/sso/test', [AuthenticationController::class, 'testSSOConnection'])
        ->name('sso.test');

});
