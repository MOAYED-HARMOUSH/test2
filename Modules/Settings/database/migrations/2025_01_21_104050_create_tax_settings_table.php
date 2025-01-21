<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('tax_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('default_rate', 5, 2)->default(0.00)->comment('معدل الضريبة الافتراضي');
            $table->timestamps();
        });

        // جدول وسيط للدول الخاضعة للضريبة
        Schema::create('tax_setting_country', function (Blueprint $table) {
            $table->foreignId('tax_setting_id')->constrained('tax_settings')->onDelete('cascade');
            $table->char('country_code', 2)->comment('رمز الدولة');
            $table->primary(['tax_setting_id', 'country_code']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tax_setting_country');
        Schema::dropIfExists('tax_settings');
    }
}