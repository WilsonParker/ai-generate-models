<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Stock\Stock;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_count', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('generates')->nullable(false)->default(0)->comment('generate 수');
            $table->unsignedBigInteger('views')->nullable(false)->default(0)->comment('조회수');
            $table->unsignedBigInteger('likes')->nullable(false)->default(0)->comment('좋아요 수');
            $table->foreignIdFor(Stock::class)
                ->unique()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_count', function (Blueprint $table) {
            $table->dropForeignIdFor(Stock::class);
            $table->dropIfExists();
        });
    }
};
