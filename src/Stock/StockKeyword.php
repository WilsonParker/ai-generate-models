<?php

namespace AIGenerate\Models\Stock;

use AIGenerate\Models\BaseModel;

class StockKeyword extends BaseModel
{
    protected $table = 'stock_keywords';
    protected $fillable = [
        'code',
    ];
}
