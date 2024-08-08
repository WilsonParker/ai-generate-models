<?php

namespace AIGenerate\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;

class UserStripeConnectAccount extends BaseModel
{
    use SoftDeletes;

    protected $table = 'user_stripe_connect_account';

    protected $fillable = [
        'connect_id',
        'express_status',
        'transfer_status',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
