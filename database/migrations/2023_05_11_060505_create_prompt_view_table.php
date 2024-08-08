<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\Prompt;
use AIGenerate\Models\User\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_view', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Prompt::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('views')->default(0)->nullable(false);
            $table->string('date')->nullable(false)->comment('Y-m-d');
            $table->unique(['user_id', 'prompt_id', 'date']);
            $table->index(['date', 'prompt_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompt_view', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(Prompt::class);
            $table->dropIfExists();
        });
    }
};
