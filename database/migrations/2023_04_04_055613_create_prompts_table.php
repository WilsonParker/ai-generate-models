<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\Enums\Status;
use AIGenerate\Models\User\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256)->nullable(false)->comment('제목');
            $table->text('description')->nullable(false)->comment('설명');
            $table->unsignedFloat('price_per_generate', 16, 12)->nullable(false)->default(0)->comment('제너레이팅 당 가격 $');
            $table->text('template')->nullable(true)->comment('prompt 탬플릿');
            $table->text('guide')->nullable(true)->comment('prompt 이용 가이드');
            $table->string('order')->nullable(true)->comment('최종 질문/요구');
            $table->text('output_result')->nullable(true)->comment('text 기반 prompt 일 경우 사용');

            $table->string('prompt_type_code', 32)->nullable(false)->comment('prompt type code');
            $table->foreign('prompt_type_code')->references('code')->on('prompt_types');

            $table->string('prompt_engine_code', 32)->nullable(true)->comment('prompt engine code');
            $table->foreign('prompt_engine_code')->references('code')->on('prompt_engines')
                  ->onUpdate('cascade');

            $table->string('prompt_status_code', 32)
                  ->nullable(false)
                  ->default(Status::Creating->value)
                  ->comment('prompt status code');
            $table->foreign('prompt_status_code')->references('code')->on('prompt_status')
                  ->onUpdate('cascade');

            $table->foreignIdFor(User::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('thumbnail_id')->nullable(true)->comment('thumbnail id');
            $table->foreign('thumbnail_id')->references('id')->on('media')
                  ->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompts', function (Blueprint $table) {
            $table->dropForeign(['prompt_type_code']);
            $table->dropForeign(['prompt_engine_code']);
            $table->dropForeign(['prompt_status_code']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['thumbnail_id']);
            $table->dropIfExists();
        });
    }
};
