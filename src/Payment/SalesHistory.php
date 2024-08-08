<?php

namespace AIGenerate\Models\Payment;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\Prompt\PromptGenerate;
use AIGenerate\Models\User\User;

class SalesHistory extends BaseModel
{
    use SoftDeletes;

    protected $table = 'sales_histories';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function promptGenerate(): BelongsTo
    {
        return $this->belongsTo(PromptGenerate::class);
    }
}
