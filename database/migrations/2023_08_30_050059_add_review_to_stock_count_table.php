<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stock_count', function (Blueprint $table) {
            $table->unsignedInteger('amazing')->default(0);
            $table->unsignedInteger('good')->default(0);
            $table->unsignedInteger('weird_face')->default(0);
            $table->unsignedInteger('twisted')->default(0);
            $table->unsignedInteger('different_picture')->default(0);
            $table->unsignedInteger('not_working')->default(0);
            $table->unsignedInteger('nsfw')->default(0);
            $table->unsignedInteger('feedback')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_count', function (Blueprint $table) {
            $table->dropColumn('amazing');
            $table->dropColumn('good');
            $table->dropColumn('weird_face');
            $table->dropColumn('twisted');
            $table->dropColumn('different_picture');
            $table->dropColumn('not_working');
            $table->dropColumn('nsfw');
            $table->dropColumn('feedback');
        });
    }
};
