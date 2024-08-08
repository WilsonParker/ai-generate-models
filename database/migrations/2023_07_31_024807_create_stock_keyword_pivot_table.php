<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Stock\Stock;
use AIGenerate\Models\Stock\StockKeyword;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_keyword_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Stock::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreignIdFor(StockKeyword::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->index(['stock_id', 'stock_keyword_id'], 'stock_keyword_pivot_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_keyword_pivots', function (Blueprint $table) {
            $table->dropForeignIdFor(Stock::class);
            $table->dropForeignIdFor(StockKeyword::class);
            $table->dropIndex('stock_keyword_pivot_index');
            $table->dropIfExists();
        });
    }
};
