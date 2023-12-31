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
        Schema::create('notification_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_setting_id')->constrained('notification_settings')->onDelete('cascade');
            $table->integer('method')->comment('通知方法。1:メール, 2:LINE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_methods');
    }
};
