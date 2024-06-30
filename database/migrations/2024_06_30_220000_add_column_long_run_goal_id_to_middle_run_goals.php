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
        Schema::table('middle_run_goals', function (Blueprint $table) {
            $table->unsignedBigInteger('long_run_goal_id')->after('id');
            
            // 外部キー設定
            $table->foreign('long_run_goal_id')->references('id')->on('long_run_goals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('middle_run_goals', function (Blueprint $table) {
            $table->dropForeign(['long_run_goal_id']);
            $table->dropColumn('long_run_goal_id');
        });
    }
};
