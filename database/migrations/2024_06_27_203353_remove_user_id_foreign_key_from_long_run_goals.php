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
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        
            // purpose_idカラム追加
            $table->unsignedBigInteger('purpose_id')->after('id');
        });
        
        Schema::table('long_run_goals', function (Blueprint $table) {
            // 外部キー設定
            $table->foreign('purpose_id')->references('id')->on('purposes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('long_run_goals', function (Blueprint $table) {
            $table->dropForeign(['purpose_id']);
            $table->dropColumn('purpose_id');
        
            // user_idカラム追加
            $table->unsignedBigInteger('user_id')->after('id');
        });
        
        Schema::table('long_run_goals', function (Blueprint $table) {
            // 外部キー設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
