@extends('users::layouts.master')

@section('title', __('Authentication Settings'))

@section('content')
<div class="container">
    <h2 class="mb-4">{{ __('Authentication Settings') }}</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- General Authentication Settings -->
    <form method="POST" action="{{ route('settings.authentication.general.save') }}" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('General Authentication Settings') }}</h5>
            
            <div class="row g-3">
                <!-- Email Verification -->
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="email_verification" 
                            id="email_verification" {{ $general->email_verification ? 'checked' : '' }}>
                        <label class="form-check-label" for="email_verification">
                            {{ __('Enable Email Verification') }}
                        </label>
                    </div>
                </div>

                <!-- WhatsApp Verification -->
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="whatsapp_verification" 
                            id="whatsapp_verification" {{ $general->whatsapp_verification ? 'checked' : '' }}>
                        <label class="form-check-label" for="whatsapp_verification">
                            {{ __('Enable WhatsApp Verification') }}
                        </label>
                    </div>
                </div>

                <!-- Force Logout -->
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="force_logout" 
                            id="force_logout" {{ $general->force_logout ? 'checked' : '' }}>
                        <label class="form-check-label" for="force_logout">
                            {{ __('Force Logout After Inactivity') }}
                        </label>
                    </div>
                </div>

                <!-- Concurrent Sessions -->
                <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="concurrent_sessions" 
                            id="concurrent_sessions" {{ $general->concurrent_sessions ? 'checked' : '' }}>
                        <label class="form-check-label" for="concurrent_sessions">
                            {{ __('Prohibit Concurrent Sessions') }}
                        </label>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </div>
    </form>

    <!-- Authentication Mechanisms -->
    <form method="POST" action="{{ route('settings.authentication.mechanisms.save') }}" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('Authentication Mechanisms') }}</h5>
            
            <!-- Abjad Authentication -->
            <div class="row g-3 border-bottom pb-3 mb-3">
                <div class="col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="mechanisms[abjad][enabled]" 
                            id="abjad_enabled" {{ $mechanisms->abjad->enabled ? 'checked' : '' }}>
                        <label class="form-check-label" for="abjad_enabled">
                            {{ __('Enable Abjad Authentication') }}
                        </label>
                    </div>
                </div>
            </div>

            <!-- Social Media Login -->
            <div class="row g-3 border-bottom pb-3 mb-3">
                <div class="col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="mechanisms[social][enabled]" 
                            id="social_enabled" {{ $mechanisms->social->enabled ? 'checked' : '' }}>
                        <label class="form-check-label" for="social_enabled">
                            {{ __('Enable Social Media Login') }}
                        </label>
                    </div>
                </div>

                <!-- Google Settings -->
                <div class="col-md-6">
                    <label class="form-label">{{ __('Google Client ID') }}</label>
                    <input type="text" name="mechanisms[social][google_client_id]" 
                        value="{{ $mechanisms->social->google_client_id }}" 
                        class="form-control" {{ !$mechanisms->social->enabled ? 'disabled' : '' }}>
                </div>

                <!-- Facebook Settings -->
                <div class="col-md-6">
                    <label class="form-label">{{ __('Facebook App ID') }}</label>
                    <input type="text" name="mechanisms[social][facebook_app_id]" 
                        value="{{ $mechanisms->social->facebook_app_id }}" 
                        class="form-control" {{ !$mechanisms->social->enabled ? 'disabled' : '' }}>
                </div>
            </div>

            <!-- OpenID Connect -->
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="mechanisms[openid][enabled]" 
                            id="openid_enabled" {{ $mechanisms->openid->enabled ? 'checked' : '' }}>
                        <label class="form-check-label" for="openid_enabled">
                            {{ __('Enable OpenID Connect') }}
                        </label>
                    </div>
                </div>

                <!-- OpenID Settings -->
                <div class="col-md-4">
                    <label class="form-label">{{ __('OpenID Provider URL') }}</label>
                    <input type="url" name="mechanisms[openid][provider_url]" 
                        value="{{ $mechanisms->openid->provider_url }}" 
                        class="form-control" {{ !$mechanisms->openid->enabled ? 'disabled' : '' }}>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('Client ID') }}</label>
                    <input type="text" name="mechanisms[openid][client_id]" 
                        value="{{ $mechanisms->openid->client_id }}" 
                        class="form-control" {{ !$mechanisms->openid->enabled ? 'disabled' : '' }}>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('Client Secret') }}</label>
                    <input type="password" name="mechanisms[openid][client_secret]" 
                        value="{{ $mechanisms->openid->client_secret }}" 
                        class="form-control" {{ !$mechanisms->openid->enabled ? 'disabled' : '' }}>
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </div>
    </form>

    <!-- Verification Methods -->
    <form method="POST" action="{{ route('settings.authentication.verification.save') }}" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('Verification Methods') }}</h5>
            
            <div class="row g-3">
                <!-- Email Verification -->
                <div class="col-md-6 border-end border-primary pe-4">
                    <h6 class="text-secondary">{{ __('Email Verification Settings') }}</h6>
                    
                    <div class="mt-3">
                        <label class="form-label">{{ __('SMTP Server') }}</label>
                        <input type="text" name="smtp_server" 
                            value="{{ $verification->smtp_server }}" 
                            class="form-control">
                    </div>
                    
                    <div class="mt-3">
                        <label class="form-label">{{ __('Email Template') }}</label>
                        <textarea name="email_template" class="form-control" rows="4">{{ $verification->email_template }}</textarea>
                    </div>
                </div>

                <!-- WhatsApp Verification -->
                <div class="col-md-6 ps-4">
                    <h6 class="text-secondary">{{ __('WhatsApp Verification Settings') }}</h6>
                    
                    <div class="mt-3">
                        <label class="form-label">{{ __('Twilio SID') }}</label>
                        <input type="text" name="twilio_sid" 
                            value="{{ $verification->twilio_sid }}" 
                            class="form-control">
                    </div>
                    
                    <div class="mt-3">
                        <label class="form-label">{{ __('WhatsApp Template') }}</label>
                        <textarea name="whatsapp_template" class="form-control" rows="4">{{ $verification->whatsapp_template }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </div>
    </form>

    <!-- SSO Settings -->
    <form method="POST" action="{{ route('settings.authentication.sso.save') }}" class="card mb-4">
        @csrf
        <div class="card-body">
            <h5 class="card-title text-primary mb-3">{{ __('Single Sign-On (SSO)') }}</h5>
            
            <div class="row g-3">
                <!-- OpenID Provider URL -->
                <div class="col-md-4">
                    <label class="form-label">{{ __('OpenID Provider URL') }}</label>
                    <input type="url" name="openid_url" 
                        value="{{ $sso->openid_url }}" 
                        class="form-control" required>
                </div>

                <!-- Client ID -->
                <div class="col-md-4">
                    <label class="form-label">{{ __('Client ID') }}</label>
                    <input type="text" name="client_id" 
                        value="{{ $sso->client_id }}" 
                        class="form-control" required>
                </div>

                <!-- Client Secret -->
                <div class="col-md-4">
                    <label class="form-label">{{ __('Client Secret') }}</label>
                    <input type="password" name="client_secret" 
                        value="{{ $sso->client_secret }}" 
                        class="form-control" required>
                </div>
            </div>

            <!-- Save and Test Buttons -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">
                    {{ __('Save Configuration') }}
                </button>
                <a href="{{ route('settings.authentication.sso.test') }}" class="btn btn-outline-danger">
                    {{ __('Test SSO Connection') }}
                </a>
            </div>
        </div>
    </form>
</div>

<!-- JavaScript to Enable/Disable Fields -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enable/Disable Social Media Fields
    const socialEnabled = document.getElementById('social_enabled');
    const googleClientId = document.querySelector('input[name="mechanisms[social][google_client_id]"]');
    const facebookAppId = document.querySelector('input[name="mechanisms[social][facebook_app_id]"]');

    socialEnabled.addEventListener('change', function() {
        googleClientId.disabled = !this.checked;
        facebookAppId.disabled = !this.checked;
    });

    // Enable/Disable OpenID Fields
    const openidEnabled = document.getElementById('openid_enabled');
    const openidFields = document.querySelectorAll('input[name^="mechanisms[openid]"]');

    openidEnabled.addEventListener('change', function() {
        openidFields.forEach(field => {
            if (field !== openidEnabled) {
                field.disabled = !this.checked;
            }
        });
    });
});
</script>
@endsection