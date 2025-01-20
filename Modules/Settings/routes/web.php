<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\Country\CountryController as CountryCountryController;
use Modules\Settings\Http\Controllers\CountryController;
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
Route::get('/countries', [CountryCountryController::class, 'index'])->name('index');
