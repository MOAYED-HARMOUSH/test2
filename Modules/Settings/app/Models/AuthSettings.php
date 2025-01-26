<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\AuthSettingsFactory;

class AuthSettings extends Model
{
    use HasFactory;

  
     protected $table = 'general_auth_settings';

     protected $fillable = [
        // General Settings
        'email_verification',
        'whatsapp_verification',
        'force_logout',
        'concurrent_sessions',

        // Authentication Mechanisms
        'abjad_enabled',
        'social_enabled',
        'google_client_id',
        'facebook_app_id',
        'openid_enabled',
        'openid_provider_url',
        'openid_client_id',
        'openid_client_secret',

        // Verification Methods
        'smtp_server',
        'email_template',
        'twilio_sid',
        'whatsapp_template',

        // SSO Settings
        'sso_provider_url',
        'sso_client_id',
        'sso_client_secret',
    ];

    protected $attributes = [
        'email_verification' => false,
        'whatsapp_verification' => false,
        'force_logout' => false,
        'concurrent_sessions' => false,

        'abjad_enabled' => false,
        'social_enabled' => false,
        'openid_enabled' => false,

        'smtp_server' => null,
        'email_template' => null,
        'twilio_sid' => null,
        'whatsapp_template' => null,

        'sso_provider_url' => null,
        'sso_client_id' => null,
        'sso_client_secret' => null,
    ];
    // protected static function newFactory(): AuthSettingsFactory
    // {
    //     // return AuthSettingsFactory::new();
    // }
}
