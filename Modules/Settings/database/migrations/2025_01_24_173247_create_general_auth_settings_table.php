<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralAuthSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_auth_settings', function (Blueprint $table) {
            $table->id();

            // General Settings
            $table->boolean('email_verification')->default(false);
            $table->boolean('whatsapp_verification')->default(false);
            $table->boolean('force_logout')->default(false);
            $table->boolean('concurrent_sessions')->default(false);

            // Authentication Mechanisms
            $table->boolean('abjad_enabled')->default(false);
            $table->boolean('social_enabled')->default(false);
            $table->string('google_client_id')->nullable();
            $table->string('facebook_app_id')->nullable();
            $table->boolean('openid_enabled')->default(false);
            $table->string('openid_provider_url')->nullable();
            $table->string('openid_client_id')->nullable();
            $table->string('openid_client_secret')->nullable();

            // Verification Methods
            $table->string('smtp_server')->nullable();
            $table->text('email_template')->nullable();
            $table->string('twilio_sid')->nullable();
            $table->text('whatsapp_template')->nullable();

            // SSO Settings
            $table->string('sso_provider_url')->nullable();
            $table->string('sso_client_id')->nullable();
            $table->string('sso_client_secret')->nullable();

            $table->timestamps(); // created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authentication_settings');
    }
}