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
            $table->unsignedSmallInteger('width')->nullable(false)->default(0);
            $table->unsignedSmallInteger('height')->nullable(false)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('text_generates', function (Blueprint $table) {
            $table->dropColumn('width');
            $table->dropColumn('height');
        });
    }
};
