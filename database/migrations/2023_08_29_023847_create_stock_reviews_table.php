<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Stock\Stock;
use AIGenerate\Models\User\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('type', 32)
                ->nullable(false)
                ->comment(
                    'stock review type code'
                );
            $table->foreign('type')
                ->references('code')
                ->on('stock_review_types')
                ->onUpdate('cascade');
            $table->text('memo')->nullable(true)->comment('feedback memo');
            $table->foreignIdFor(Stock::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_reviews', function (Blueprint $table) {
            $table->dropForeign(['type']);
            $table->dropForeign(['stock_id']);
            $table->dropForeign(['user_id']);
            $table->dropIfExists();
        });
    }
};
