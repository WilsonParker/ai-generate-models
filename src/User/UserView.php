<?php

namespace AIGenerate\Models\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class UserView extends BaseModel
{
    protected $table = 'user_view';

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }
}
