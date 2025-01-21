<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->comment('اسم الشركة');
            $table->text('company_address')->comment('عنوان الشركة');
            $table->string('tax_number')->comment('الرقم الضريبي');
            $table->string('logo_path')->nullable()->comment('مسار الشعار');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_settings');
    }
}