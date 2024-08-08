<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\PromptGenerate;
use AIGenerate\Models\Prompt\PromptOption;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_generate_options', function (Blueprint $table) {
            $table->id();

            $table->string('value', 512)->nullable(false)->comment('prompt generate option 값');
            $table->foreignIdFor(PromptGenerate::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignIdFor(PromptOption::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompt_generate_options', function (Blueprint $table) {
            $table->dropForeignIdFor(PromptGenerate::class);
            $table->dropForeignIdFor(PromptOption::class);
            $table->dropIfExists();
        });
    }
};
