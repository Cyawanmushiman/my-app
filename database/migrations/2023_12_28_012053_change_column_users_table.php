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
        Schema::table('users', function (Blueprint $table) {
            // emailをnullableに変更
            $table->string('email')->nullable()->change();
            // passwordをnullableに変更
            $table->string('password')->nullable()->change();
            $table->string('provider')->nullable()->after('password');
            $table->string('line_id')->nullable()->after('provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // emailをnullableに変更
            $table->string('email')->nullable(false)->change();
            // passwordをnullableに変更
            $table->string('password')->nullable(false)->change();
            $table->dropColumn('provider');
            $table->dropColumn('line_id');
        });
    }
};
