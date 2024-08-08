<?php

namespace AIGenerate\Models\Payment;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class SettlementDetail extends BaseModel
{
    use SoftDeletes;

    protected $table = 'settlement_details';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
