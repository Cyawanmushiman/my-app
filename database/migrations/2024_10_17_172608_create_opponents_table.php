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
        Schema::create('opponents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('敵の名前');
            $table->unsignedInteger('max_hit_point')->comment('最大HP');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opponents');
    }
};
