<?php

namespace AIGenerate\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class UserCount extends BaseModel
{
    protected $table = 'user_count';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
