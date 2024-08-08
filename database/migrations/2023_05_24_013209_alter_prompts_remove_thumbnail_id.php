<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prompts', function (Blueprint $table) {
            $table->dropForeign(['thumbnail_id']);
            $table->dropColumn(['thumbnail_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // sail artisan migrate --path=app/Modules/Models/database/migrations
        Schema::table('prompts', function (Blueprint $table) {
            $table->unsignedBigInteger('thumbnail_id')->nullable(true)->comment('thumbnail id');
            $table->foreign('thumbnail_id')->references('id')->on('media')
                  ->onUpdate('cascade');
        });
    }
};
