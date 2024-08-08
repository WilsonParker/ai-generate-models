<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stock_generates', function (Blueprint $table) {
            $table->string('ethnicity', 32)->nullable();
            $table->string('gender', 32)->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->boolean('is_skin_reality')->nullable();
            $table->boolean('is_pose_variation')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('stock_generates', function (Blueprint $table) {
            $table->dropColumn('ethnicity');
            $table->dropColumn('gender');
            $table->dropColumn('age');
            $table->dropColumn('is_skin_reality');
            $table->dropColumn('is_pose_variation');
        });

    }
};
