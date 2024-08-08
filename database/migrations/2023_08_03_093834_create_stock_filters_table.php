<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_filters', function (Blueprint $table) {
            $table->id();
            $table->string('code', 64)->nullable(false)->unique();
            $table->string('name', 64)->nullable(false)->unique();
            $table->string('parent', 64)->nullable(true)->comment('부모코드');
            $table->integer('depth')->nullable(false)->comment('단계');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_filters');
    }
};
