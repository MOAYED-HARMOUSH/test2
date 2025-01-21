<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\InvoiceSettingsFactory;

class InvoiceSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'invoice_settings';
    protected $fillable = ['company_name', 'company_address', 'tax_number', 'logo_path'];

    // protected static function newFactory(): InvoiceSettingsFactory
    // {
    //     // return InvoiceSettingsFactory::new();
    // }
}
