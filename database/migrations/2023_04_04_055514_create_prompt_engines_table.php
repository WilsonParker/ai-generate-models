<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prompt_engines', function (Blueprint $table) {
            $table->string('code', 32)->primary();
            $table->string('name', 32)->nullable(true);

            $table->string('prompt_type_code', 32)->nullable(false)->comment('prompt type code');
            $table->foreign('prompt_type_code')->references('code')->on('prompt_types')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('prompt_engines', function (Blueprint $table) {
            $table->dropForeign(['prompt_type_code']);
            $table->dropIfExists();
        });
    }
};
