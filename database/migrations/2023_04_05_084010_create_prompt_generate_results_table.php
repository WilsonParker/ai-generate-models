<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\PromptGenerate;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_generate_results', function (Blueprint $table) {
            $table->id();
            $table->text('result')->nullable(false)->comment('api result');
            $table->foreignIdFor(PromptGenerate::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompt_generate_results', function (Blueprint $table) {
            $table->dropForeignIdFor(PromptGenerate::class);
            $table->dropIfExists();
        });
    }
};
