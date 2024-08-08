<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\User\User;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('search_keywords', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                  ->nullable(true)
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->onUpdate('set null');
            $table->string('ip', 32);
            $table->string('keyword', 128)->nullable(false);
            $table->unsignedInteger('result_count')->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('search_keywords', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropIfExists();
        });
    }
};
