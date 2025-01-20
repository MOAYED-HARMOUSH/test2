<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\CountryFactory;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'dialing_code', 'user_count'];
    protected $casts = ['name' => 'array'];

    // protected static function newFactory(): CountryFactory
    // {
    //     // return CountryFactory::new();
    // }
}
