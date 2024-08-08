<?php

namespace AIGenerate\Models\Stock;

use AIGenerate\Models\BaseModel;

class StockCategoryPivot extends BaseModel
{
    protected $table = 'stock_category_pivots';

    protected $fillable = [
        'stock_id',
        'stock_category_id',
    ];

}
