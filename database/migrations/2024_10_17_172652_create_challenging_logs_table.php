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
        Schema::create('challenging_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenging_id')->constrained('challengings')->cascadeOnDelete();
            $table->unsignedTinyInteger('archive_count')->comment('達成した目標の数');
            $table->unsignedInteger('un_archive_count')->comment('未達成の目標の数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenging_logs');
    }
};
