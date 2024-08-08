<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\User\User;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_constants', function (Blueprint $table) {
            $table->id();
            $table->boolean('free_generate_completed')->default(false)->comment('무료 generate 완료 여부');
            $table->boolean('first_paid_generate')->default(false)->comment('첫 유료 generate 여부');
            $table->boolean('reach_generated_revenue')->default(false)->comment('첫 매출 $? 달성 여부');
            $table->boolean('point_less_than')->default(false)->comment('잔액 $? 이하 달성');
            $table->boolean('my_prompt_first_generated')->default(false)->comment('본인 상품 첫 generate 여부');
            $table->boolean('my_prompt_5times_generated')->default(false)->comment('본인 상품 첫 5회 generate 여부');
            $table->unsignedTinyInteger('free_generate_count')->default(0)->comment('무료 generate 사용 횟수');
            $table->foreignIdFor(User::class)
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
        Schema::dropIfExists('user_constants');
    }
};
