<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewaySettingsTable extends Migration
{
    public function up()
    {
        Schema::create('gateway_settings', function (Blueprint $table) {
            $table->id();
            $table->string('gateway_name')->unique()->comment('اسم بوابة الدفع');
            $table->text('api_key')->comment('مفتاح API');
            $table->text('secret_key')->comment('المفتاح السري');
            $table->string('currency_symbol', 10)->comment('رمز العملة');
            $table->enum('symbol_position', ['before', 'after'])->comment('مكان ظهور الرمز');
            $table->string('thousands_separator', 1)->comment('فاصل الآلاف');
            $table->string('decimal_separator', 1)->comment('فاصل العشرات');
            $table->boolean('is_active')->default(false)->comment('حالة البوابة');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('gateway_settings');
    }
}