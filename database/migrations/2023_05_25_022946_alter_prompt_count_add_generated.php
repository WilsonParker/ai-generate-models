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
        Schema::table('user_count', function (Blueprint $table) {
            $table->unsignedInteger('generated')->default(0)->comment('해당 user 의 prompt 를 generate 한 수');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_count', function (Blueprint $table) {
            $table->dropColumn('generated');
        });
    }
};
