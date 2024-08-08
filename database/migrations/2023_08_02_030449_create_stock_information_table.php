<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Stock\Stock;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_information', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Stock::class)
                ->unique()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('ethnicity');
            $table->string('gender');
            $table->unsignedTinyInteger('people_number');
            $table->timestamps();
            $table->index(['ethnicity', 'gender']);
        });
    }

    public function down(): void
    {
        Schema::table('stock_information', function (Blueprint $table) {
            $table->dropForeign(['stock_id']);
            $table->dropIfExists();
        });
    }
};
