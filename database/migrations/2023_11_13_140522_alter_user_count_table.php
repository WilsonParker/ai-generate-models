<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_count', function (Blueprint $table) {
            $table->unsignedInteger('text_generate_exports')
                ->nullable(false)
                ->default(0)
                ->comment('text generate export 수');

            $table->unsignedInteger('text_generates')
                ->nullable(false)
                ->default(0)
                ->comment('text generate 수');
        });
    }

    public function down(): void
    {
        Schema::table('user_count', function (Blueprint $table) {
            $table->dropColumn('text_generate_exports');
            $table->dropColumn('text_generates');
        });

    }
};
