<?php

namespace AIGenerate\Models\Stock;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class StockLike extends BaseModel
{
    use SoftDeletes;
    
    protected $table = 'stock_likes';

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
