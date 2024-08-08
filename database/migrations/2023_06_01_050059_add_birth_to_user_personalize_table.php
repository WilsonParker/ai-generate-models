<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_personalize', function (Blueprint $table) {
            $table->date('birth')->nullable(true)->comment('생년월일');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_personalize', function (Blueprint $table) {
            $table->dropColumn(['birth']);
        });
    }
};
