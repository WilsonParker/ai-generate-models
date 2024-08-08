<?php

use AIGenerate\Services\Stripe\Enums\EventTypes;
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
        Schema::create('stripe_webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                  ->constrained()
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->string('event_id', 256)->unique()->comment('stripe event id');
            $table->string('stripe_webhook_type_code', 32)
                  ->nullable(false)
                  ->default(EventTypes::NOT_FOUND->value)
                  ->comment(
                      'stripe webhook type code'
                  );
            $table->foreign('stripe_webhook_type_code')->references('code')->on('stripe_webhook_types')
                  ->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stripe_webhook_logs', function (Blueprint $table) {
            $table->dropForeign(['stripe_webhook_type_code']);
            $table->dropIfExists();
        });
    }
};
