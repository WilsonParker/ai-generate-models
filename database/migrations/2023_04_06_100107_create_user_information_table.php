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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->string('google_id', 256)->nullable(false)->comment('google id');
            $table->string('avatar', 512)->nullable(true)->comment('avatar');
            $table->string('locale', 8)->nullable(false)->comment('locale');
            $table->text('introduction')->nullable(true)->comment('introduction');
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
        Schema::table('user_information', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropIfExists();
        });
    }
};
