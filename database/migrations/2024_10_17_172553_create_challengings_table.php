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
        Schema::create('challengings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('reward')->nullable()->comment('報酬');
            $table->string('reward_link')->nullable()->comment('報酬リンク');
            $table->unsignedTinyInteger('result_status')->default(10)->comment('challenging = 10、win = 20、lose = 30');
            $table->date('archived_on')->nullable()->comment('達成した日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challengings');
    }
};
