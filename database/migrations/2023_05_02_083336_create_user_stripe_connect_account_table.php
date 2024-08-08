<?php

use AIGenerate\Services\Stripe\Enums\Status;
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
        Schema::create('user_stripe_connect_account', function (Blueprint $table) {
            $table->id();
            $table->string('connect_id', 256)->unique()->comment('stripe connect account id');
            $table->string('express_status', 32)->nullable(false)->default(Status::inactive->value)->comment(
                'stripe express status code'
            );
            $table->foreign('express_status')->references('code')->on('stripe_status')
                  ->onUpdate('cascade');

            $table->string('transfer_status', 32)->nullable(false)->default(Status::inactive->value)->comment(
                'stripe transfer status code'
            );
            $table->foreign('transfer_status')->references('code')->on('stripe_status')
                  ->onUpdate('cascade');
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
        Schema::table('user_stripe_connect_account', function (Blueprint $table) {
            $table->dropForeign(['express_status']);
            $table->dropForeign(['transfer_status']);
            $table->dropForeign(['user_id']);
            $table->dropIfExists();
        });
    }
};
