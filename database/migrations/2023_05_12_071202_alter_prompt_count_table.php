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
        Schema::table('prompt_count', function (Blueprint $table) {
            $table->unsignedBigInteger('generated')->nullable(false)->default(0)->comment('즐겨찾기 수');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompt_count', function (Blueprint $table) {
            $table->dropColumn(['generated']);
        });
    }
};
