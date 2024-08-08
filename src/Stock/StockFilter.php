<?php

namespace AIGenerate\Models\Stock;

use AIGenerate\Models\BaseModel;

class StockFilter extends BaseModel
{
    protected $table = 'stock_filters';

    protected $fillable = [
        'code',
        'name',
        'parent',
        'depth',
    ];
}
