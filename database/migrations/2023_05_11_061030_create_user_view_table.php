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
        Schema::create('user_view', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'from_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'to_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('views')->default(0)->nullable(false);
            $table->string('date')->nullable(false)->comment('Y-m-d');
            $table->unique(['from_id', 'to_id', 'date']);
            $table->index(['to_id', 'from_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_view', function (Blueprint $table) {
            $table->dropForeign(['from_id']);
            $table->dropForeign(['to_id']);
            $table->dropIfExists();
        });
    }
};
