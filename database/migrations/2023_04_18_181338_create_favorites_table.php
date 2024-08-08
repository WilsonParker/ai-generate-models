<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\Prompt;
use AIGenerate\Models\User\User;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prompt_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Prompt::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['user_id', 'prompt_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('prompt_favorites', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(Prompt::class);
            $table->dropIfExists();
        });
    }
};
