<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_generate_writing_style', function (Blueprint $table) {
            $table->string('code', 32)->nullable(false)->primary()->comment('code');
            $table->string('name', 32)->nullable(false)->comment('writing style');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompt_generate_writing_style');
    }
};
