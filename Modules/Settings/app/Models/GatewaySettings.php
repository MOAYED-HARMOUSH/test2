<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\GatewaySettingsFactory;

class GatewaySettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'gateway_settings';
    protected $fillable = ['gateway_name', 'api_key', 'secret_key', 'is_active'];

    protected $casts = [
        'api_key' => 'encrypted',
        'secret_key' => 'encrypted',
    ];
    // protected static function newFactory(): GatewaySettingsFactory
    // {
    //     // return GatewaySettingsFactory::new();
    // }
}
