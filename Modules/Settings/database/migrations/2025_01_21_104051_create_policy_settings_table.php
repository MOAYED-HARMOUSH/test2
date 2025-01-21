<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicySettingsTable extends Migration
{
    public function up()
    {
        Schema::create('policy_settings', function (Blueprint $table) {
            $table->id();
            $table->text('payment_policy')->comment('سياسة الدفع');
            $table->text('refund_policy')->comment('سياسة الاسترجاع');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('policy_settings');
    }
}