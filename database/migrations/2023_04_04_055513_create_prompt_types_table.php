<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prompt_types', function (Blueprint $table) {
            $table->string('code', 32)->primary();
            $table->string('type', 32)->nullable(false);
            $table->string('name', 32)->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prompt_types');
    }
};
