<?php

namespace AIGenerate\Models\Stock;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class StockView extends BaseModel
{
    protected $table = 'stock_view';

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
