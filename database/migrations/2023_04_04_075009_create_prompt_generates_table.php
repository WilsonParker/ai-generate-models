<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\Prompt;
use AIGenerate\Models\User\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_generates', function (Blueprint $table) {
            $table->id();
            $table->text('order')->nullable(true)->comment('last order for user');
            $table->integer('max_tokens')->nullable(true)->comment('max token for result');
            $table->string('image_size', 16)->nullable(true)->comment('size for image result');
            $table->text('template')->nullable(false)->comment('template before generate');

            $table->unsignedFloat('price', 16, 12)->nullable(false)->default(0)->comment('generate 총 비용');
            $table->unsignedFloat('seller_price', 16, 12)->nullable(false)->default(0)->comment('판매자 설정 비용');
            $table->unsignedFloat('input_price', 16, 12)->nullable(false)->default(0)->comment('입력 비용');
            $table->unsignedFloat('output_price', 16, 12)->nullable(false)->default(0)->comment('결과 비용');

            $table->foreignIdFor(Prompt::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignIdFor(User::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->timestamp('expired_at')->nullable(true)->comment('result expired at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompt_generates', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['prompt_id']);
            $table->dropIfExists();
        });
    }
};
