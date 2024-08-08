<?php

namespace AIGenerate\Models\Stock;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class SearchKeyword extends BaseModel
{
    protected $table = 'search_keywords';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
