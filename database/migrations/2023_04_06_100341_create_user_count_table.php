<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\User\User;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_count', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('views')->nullable(false)->default(0)->comment('조회 수');
            $table->unsignedInteger('follows')->nullable(false)->default(0)->comment('팔로우 수');
            $table->unsignedInteger('followings')->nullable(false)->default(0)->comment('팔로잉 수');
            $table->unsignedInteger('generates')->nullable(false)->default(0)->comment('generate 수');

            $table->foreignIdFor(User::class)
                  ->unique()
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('user_count', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropIfExists();
        });
    }
};
