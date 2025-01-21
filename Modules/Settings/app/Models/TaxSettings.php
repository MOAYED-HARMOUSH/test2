<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\TaxSettingsFactory;

class TaxSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'tax_settings';
    protected $fillable = ['default_rate','countryId'];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'tax_setting_country', 'tax_setting_id', 'country_code');
    }
     public function country()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }
}
