<?php

namespace AIGenerate\Models\Stock;

use AIGenerate\Models\BaseModel;

class StockKeywordPivot extends BaseModel
{
    protected $table = 'stock_keyword_pivots';
    protected $fillable = [
        'stock_id',
        'stock_keyword_id',
    ];
}
