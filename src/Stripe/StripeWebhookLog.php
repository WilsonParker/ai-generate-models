<?php

namespace AIGenerate\Models\Stripe;

use Illuminate\Database\Eloquent\Relations\HasMany;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class StripeWebhookLog extends BaseModel
{
    protected $table = 'stripe_webhook_logs';

    protected $fillable = [
        'user_id',
        'event_id',
        'stripe_webhook_type_code',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
