<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\TextGenerate\TextGenerate;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('text_generate_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TextGenerate::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('text_generate_exports', function (Blueprint $table) {
            $table->dropForeignIdFor(TextGenerate::class);
            $table->dropIfExists();
        });

    }
};
