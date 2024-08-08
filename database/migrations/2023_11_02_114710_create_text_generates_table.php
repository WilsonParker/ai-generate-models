<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\User\User;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('text_generates', function (Blueprint $table) {
            $table->id();
            $table->string('type_code', 16)->nullable(false)->comment('type code');
            $table->foreign('type_code')->references('code')->on('text_generate_types')->cascadeOnUpdate();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate();
            $table->text('prompt')->nullable(false);
            $table->string('ratio', 64)->nullable(true);
            $table->string('gender', 16)->nullable(true);
            $table->string('ethnicity', 64)->nullable(true);
            $table->unsignedTinyInteger('age')->nullable(true);
            $table->boolean('is_skin_reality')->nullable(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('text_generates', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropIfExists();
        });
    }
};
