<?php

namespace Modules\Settings\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\AuthenticationSettings;

class AuthenticationController extends Controller
{
    // General Settings
    public function showGeneralSettings()
    {
        // Dummy data for General Authentication Settings
        $general = (object) [
            'email_verification' => true,
            'whatsapp_verification' => false,
            'force_logout' => true,
            'concurrent_sessions' => false,
        ];
    
        // Dummy data for Authentication Mechanisms
        $mechanisms = (object) [
            'abjad' => (object) [
                'enabled' => true, // Enable/Disable Abjad Authentication
            ],
            'social' => (object) [
                'enabled' => true, // Enable/Disable Social Media Login
                'google_client_id' => '1234567890-abcdefghijklmnopqrstuvwxyz.apps.googleusercontent.com',
                'facebook_app_id' => '987654321012345',
            ],
            'openid' => (object) [
                'enabled' => false, // Enable/Disable OpenID Connect
                'provider_url' => 'https://sso.example.com',
                'client_id' => 'sso-client-id-12345',
                'client_secret' => 'sso-client-secret-67890',
            ],
        ];
    
        // Dummy data for Verification Methods
        $verification = (object) [
            'smtp_server' => 'smtp.example.com',
            'email_template' => 'Welcome to our platform! Please verify your email.',
            'twilio_sid' => 'test12',
            'whatsapp_template' => 'Your verification code is: {code}',
        ];
     // Dummy data for SSO Settings
     $sso = (object) [
        'openid_url' => 'https://sso.example.com',
        'client_id' => 'sso-client-id-12345',
        'client_secret' => 'sso-client-secret-67890',
    ];

    // Pass all variables to the view
    return view('settings::Authentication.AuthenticationSettings', compact('general', 'mechanisms', 'verification', 'sso'));
 }
    public function saveGeneralSettings(Request $request)
    {
        $data = $request->validate([
            'enable_email_verification' => 'boolean',
            'enable_whatsapp_verification' => 'boolean',
            'force_logout' => 'boolean',
            'prohibit_concurrent_sessions' => 'boolean',
        ]);

        // AuthenticationSettings::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', __('General settings saved successfully!'));
    }

    // Authentication Mechanisms
    public function showMechanisms()
    {
        // $mechanisms = AuthenticationSettings::first();
        return view('settings.authentication.mechanisms', compact('mechanisms'));
    }

    public function saveMechanisms(Request $request)
    {
        $data = $request->validate([
            'primary_method' => 'required|in:abjad,social,openid',
            'google_client_id' => 'nullable|string',
            'facebook_app_id' => 'nullable|string',
        ]);

        // AuthenticationSettings::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', __('Authentication mechanisms saved successfully!'));
    }

    public function testMechanisms()
    {
        // Logic to test social media connections
        return redirect()->back()->with('success', __('Connections tested successfully!'));
    }

    // Verification Methods
    public function showVerificationSettings()
    {
        // $verification = AuthenticationSettings::first();
        return view('settings.authentication.verification', compact('verification'));
    }

    public function saveVerificationSettings(Request $request)
    {
        $data = $request->validate([
            'smtp_server' => 'nullable|string',
            'email_template' => 'nullable|string',
            'twilio_sid' => 'nullable|string',
            'whatsapp_template' => 'nullable|string',
        ]);

        // AuthenticationSettings::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', __('Verification settings saved successfully!'));
    }

    // SSO Settings
    public function showSSOSettings()
    {
        // $sso = AuthenticationSettings::first();
        return view('settings.authentication.sso', compact('sso'));
    }

    public function saveSSOSettings(Request $request)
    {
        $data = $request->validate([
            'openid_url' => 'required|url',
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
        ]);

        // AuthenticationSettings::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', __('SSO settings saved successfully!'));
    }

    public function testSSOConnection()
    {
        // Logic to test SSO connection
        return redirect()->back()->with('success', __('SSO connection tested successfully!'));
    }
}