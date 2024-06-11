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
        Schema::table('mind_maps', function (Blueprint $table) {
            $table->dropColumn('is_favorite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mind_maps', function (Blueprint $table) {
            $table->boolean('is_favorite')->default(false)->after('user_id');
        });
    }
};
