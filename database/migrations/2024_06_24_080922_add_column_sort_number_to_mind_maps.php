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
            $table->unsignedTinyInteger('sort_number')->nullable()->after('mind_data_json')->comment('並び順');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mind_maps', function (Blueprint $table) {
            $table->dropColumn('sort_number');
        });
    }
};
