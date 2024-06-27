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
        // long_run_goalsテーブルにschedule_onカラムを追加
        Schema::table('long_run_goals', static function (Blueprint $table) {
            $table->date('schedule_on')->comment('目的達成予定日')->after('title');
        });
        
        // middle_run_goalsテーブルにschedule_onカラムを追加
        Schema::table('middle_run_goals', static function (Blueprint $table) {
            $table->date('schedule_on')->comment('目的達成予定日')->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // long_run_goalsテーブルのschedule_onカラムを削除
        Schema::table('long_run_goals', static function (Blueprint $table) {
            $table->dropColumn('schedule_on');
        });
        
        // middle_run_goalsテーブルのschedule_onカラムを削除
        Schema::table('middle_run_goals', static function (Blueprint $table) {
            $table->dropColumn('schedule_on');
        });
    }
};
