<?php

namespace AIGenerate\Models\Stock;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;

class StockReview extends BaseModel
{
    use SoftDeletes;

    protected $table = 'stock_reviews';

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

}
