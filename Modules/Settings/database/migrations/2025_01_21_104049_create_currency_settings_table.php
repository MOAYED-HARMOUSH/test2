<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencySettingsTable extends Migration
{
    public function up()
    {
        Schema::create('currency_settings', function (Blueprint $table) {
            $table->id();
            $table->char('default_currency', 3)->default('USD')->comment('العملة الافتراضية');
            $table->enum('price_display', ['symbol', 'name'])->default('symbol')->comment('طريقة عرض السعر');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('currency_settings');
    }
}