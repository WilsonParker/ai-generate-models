<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\User\User;

return new class extends Migration {
    public function up(): void
    {
        // 포인트 충전 사용 내역
        Schema::create('point_history', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('point_type_code', 32)->nullable(false)->comment('point type code');
            $table->foreign('point_type_code')->references('code')->on('point_types');
            $table->unsignedFloat('point', 24, 12)->nullable(false)->comment('충전 또는 사용 포인트');
            $table->unsignedFloat('remained', 24, 12)->nullable(false)->comment('현재 남은 포인트');
            $table->string('description', 512)->comment('설명');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('point_history', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeign(['point_type_code']);
            $table->dropIfExists();
        });
    }
};
