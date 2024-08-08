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
        Schema::table('text_generates', function (Blueprint $table) {
            $table->boolean('is_complete')->default(false)->comment('완료 여부');
        });
    }

    public function down(): void
    {
        Schema::table('text_generates', function (Blueprint $table) {
            $table->dropColumn('is_complete');
        });
    }
};
