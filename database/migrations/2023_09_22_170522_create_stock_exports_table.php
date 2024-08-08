<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Stock\StockGenerate;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StockGenerate::class)
                  ->constrained()
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('stock_exports', function (Blueprint $table) {
            $table->dropForeignIdFor(StockGenerate::class);
            $table->dropIfExists();
        });

    }
};
