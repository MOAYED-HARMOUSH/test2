<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\PolicySettingsFactory;

class PolicySettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'policy_settings';
    protected $fillable = ['payment_policy', 'refund_policy'];
    // protected static function newFactory(): PolicySettingsFactory
    // {
    //     // return PolicySettingsFactory::new();
    // }
}
