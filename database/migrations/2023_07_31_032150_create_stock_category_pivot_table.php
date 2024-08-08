<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Stock\Stock;
use AIGenerate\Models\Stock\StockCategory;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_category_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Stock::class)
                  ->nullable(false)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignIdFor(StockCategory::class)
                  ->nullable(false)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unique(['stock_id', 'stock_category_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_category_pivots', function (Blueprint $table) {
            $table->dropForeign(['stock_id']);
            $table->dropForeign(['stock_category_id']);
            $table->dropIfExists();
        });
    }
};
