<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\CurrencySettingsFactory;

class CurrencySettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'currency_settings'; // اسم الجدول
    protected $fillable = ['default_currency', 'price_display']; // الحقول القابلة للتعبئة

    // protected static function newFactory(): CurrencySettingsFactory
    // {
    //     // return CurrencySettingsFactory::new();
    // }
}
