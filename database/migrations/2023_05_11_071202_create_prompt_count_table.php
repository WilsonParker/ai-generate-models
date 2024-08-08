<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\Prompt;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_count', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('views')->nullable(false)->default(0)->comment('조회수');
            $table->unsignedBigInteger('favorites')->nullable(false)->default(0)->comment('즐겨찾기 수');
            $table->foreignIdFor(Prompt::class)
                  ->unique()
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompt_count', function (Blueprint $table) {
            $table->dropForeignIdFor(Prompt::class);
            $table->dropIfExists();
        });
    }
};
