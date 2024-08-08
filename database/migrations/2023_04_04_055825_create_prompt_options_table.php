<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use AIGenerate\Models\Prompt\Prompt;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prompt_options', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256)->nullable(false)->comment('옵션 이름');
            $table->text('value')->nullable(true)->comment('옵션 값');

            $table->foreignIdFor(Prompt::class)
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prompt_options', function (Blueprint $table) {
            $table->dropForeign(['prompt_id']);
            $table->dropIfExists();
        });
    }
};
