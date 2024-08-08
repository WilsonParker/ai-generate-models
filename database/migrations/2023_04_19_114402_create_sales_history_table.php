<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\PromptGenerate;
use AIGenerate\Models\User\User;

return new class extends Migration {
    public function up(): void
    {
        // 판매 내역
        Schema::create('sales_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('price')->nullable(false)->comment('generate 비용');
            $table->unsignedInteger('remained')->nullable(false)->comment('정산 시 남은 비용');
            $table->string('description', 512)->comment('설명');
            $table->foreignIdFor(User::class)->constrained()->comment('판매자');
            $table->foreignIdFor(PromptGenerate::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('sales_history', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(PromptGenerate::class);
            $table->dropIfExists();
        });
    }
};
