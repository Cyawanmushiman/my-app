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
        Schema::table('long_run_goals', function (Blueprint $table) {
            $table->date('start_on')->comment('目標開始日')->after('finish_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('long_run_goals', function (Blueprint $table) {
            $table->dropColumn('start_on');
        });
    }
};
