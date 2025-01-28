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
            $table->char('currency', 3)->default('USD');
            $table->char('symbol',3)->default('$');
            $table->enum('display', ['symbol', 'name'])->default('symbol');
            $table->boolean('isdefault');
            $table->double('exchangeRate');
         
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('currency_settings');
    }
}