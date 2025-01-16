<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->index(); // البريد الإلكتروني الذي يتم استخدامه لإعادة التعيين
            $table->string('token');          // رمز إعادة التعيين
            $table->timestamp('created_at')->nullable(); // توقيت إنشاء الطلب
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
