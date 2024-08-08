<?php

namespace AIGenerate\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;

class UserStripeCustomerAccount extends BaseModel
{
    use SoftDeletes;

    protected $table = 'user_stripe_customer_account';

    protected $fillable = [
        'customer_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
