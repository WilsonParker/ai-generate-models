<?php

namespace AIGenerate\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class UserConstant extends BaseModel
{
    protected $table = 'user_constants';
    protected $casts = [
        'free_generate_completed' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
