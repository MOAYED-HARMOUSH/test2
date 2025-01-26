<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Users\Database\Factories\PasswordResetCodeFactory;

class PasswordResetCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): PasswordResetCodeFactory
    // {
    //     // return PasswordResetCodeFactory::new();
    // }
}
