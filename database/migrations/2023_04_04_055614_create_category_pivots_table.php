<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\Prompt;
use AIGenerate\Models\Prompt\PromptCategory;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prompt_category_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PromptCategory::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Prompt::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('prompt_category_pivots', function (Blueprint $table) {
            $table->dropForeign(['prompt_category_id']);
            $table->dropForeign(['prompt_id']);
            $table->dropIfExists();
        });
    }
};
