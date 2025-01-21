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
            $table->foreignId('countryId')->constrained('countries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
       Schema::dropIfExists('tax_settings');
    }
}