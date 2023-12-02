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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('inspire_count')->default(0)->comment('インスパイア回数');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('has_first_goal')->default(false)->comment('目標決定済みフラグ');
            $table->boolean('is_mind_map_create')->default(false)->comment('マインドマップ説明フラグ');
            $table->boolean('has_daily_goal')->default(false)->comment('毎日の目標説明フラグ');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
