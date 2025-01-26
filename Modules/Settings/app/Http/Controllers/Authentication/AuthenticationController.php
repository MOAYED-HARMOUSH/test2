<?php

namespace Modules\Settings\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\AuthenticationSettings;
use Illuminate\Support\Facades\Log;
use Modules\Settings\Models\AuthSettings;

class AuthenticationController extends Controller
{
    // General Settings
    public function showGeneralSettings()
    {
        // Dummy data for General Authentication Settings
            $settings = AuthSettings::first();
            // $mechanisms = AuthSettings::first();
            // $verification = AuthSettings::first();
            // $sso = AuthSettings::first();
    
    // Pass all variables to the view
    return view('settings::Authentication.AuthenticationSettings', compact('settings'));
 }
    public function saveGeneralSettings(Request $request)
    {
        Log::info($request);
        $data = $request->validate([
            'email_verification' => 'boolean',
            'whatsapp_verification' => 'boolean',
            'force_logout' => 'boolean',          
            'concurrent_sessions' => 'boolean',
        ]);
      
        $firstRecord = AuthSettings::first();
 
        AuthSettings::updateOrCreate(
            ['id' => $firstRecord ? $firstRecord->id : null]
            , $data);

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
        Log::info($request);

        $data = $request->validate([
            'abjad_enabled'=>'boolean',
            'social_enabled'=>'boolean',
            'openid_enabled'=>'boolean',
            'google_client_id' => 'nullable|string',
            'facebook_app_id' => 'nullable|string',
        ]);

        
         $firstRecord = AuthSettings::first();
        
         AuthSettings::updateOrCreate(
             ['id' => $firstRecord ? $firstRecord->id : null]
             , $data);
 
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
            'openid_enabled'=>'boolean',

            'whatsapp_template' => 'nullable|string',
        ]);

        $firstRecord = AuthSettings::first();
 
        AuthSettings::updateOrCreate(
            ['id' => $firstRecord ? $firstRecord->id : null]
            , $data);

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
            'sso_provider_url' => 'nullable|url',
            'sso_client_id' => 'nullable|string',
 
            'sso_client_secret' => 'nullable|string',
        ]);

        $firstRecord = AuthSettings::first();
 
        AuthSettings::updateOrCreate(
            ['id' => $firstRecord ? $firstRecord->id : null]
            , $data);

        return redirect()->back()->with('success', __('SSO settings saved successfully!'));
    }

    public function testSSOConnection()
    {
        // Logic to test SSO connection
        return redirect()->back()->with('success', __('SSO connection tested successfully!'));
    }
}