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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path', 512)->nullable(false)->comment('경로');
            $table->string('name', 512)->nullable(false)->comment('이름');
            $table->string('origin_name', 512)->nullable(false)->comment('원본 이름');
            $table->unsignedInteger('size')->nullable(false)->comment('크기');
            $table->string('mime', 256)->nullable(false)->comment('MIME');
            $table->morphs('imageable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
