<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
 use Modules\Settings\Models\AuthSettings;

class AuthenticationSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the table (optional)
        AuthSettings::truncate();

        // Create General Settings
        AuthSettings::create([
            'email_verification' => true,
            'whatsapp_verification' => false,
            'force_logout' => true,
            'concurrent_sessions' => false,

            'abjad_enabled' => true,
            'social_enabled' => true,
            'google_client_id' => 'test',
            'facebook_app_id' => 'test',
            'openid_enabled' => false,
            'openid_provider_url' => 'https://sso.example.com',
            'openid_client_id' => 'test',
            'openid_client_secret' => 'test',
            'smtp_server' => 'smtp.example.com',
            'email_template' => 'Welcome to our platform! Please verify your email.',
            'twilio_sid' => '',
            'whatsapp_template' => 'Your verification code is: {code}',
            'sso_provider_url' => 'https://sso.example.com',
            'sso_client_id' => 'test',
            'sso_client_secret' => 'test',
        ]);

        $this->command->info('Authentication settings seeded successfully!');
    }
}