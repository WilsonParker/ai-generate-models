<?php

namespace AIGenerate\Models\Stock;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class StockCount extends BaseModel
{
    protected $table = 'stock_count';

    protected $fillable = [
        'generates',
        'views',
        'likes',
        'stock_id',
        'stock_generates',
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'id');
    }
}
