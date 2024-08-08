<?php

namespace AIGenerate\Models\Stock;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class StockRecommend extends BaseModel
{
    protected $table = 'stock_recommends';

    protected $fillable = [
        'stock_id',
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function information(): BelongsTo
    {
        return $this->belongsTo(StockInformation::class, 'stock_id', 'stock_id');
    }
}
