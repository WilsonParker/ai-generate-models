<?php

namespace AIGenerate\Models\Stock;

use AIGenerate\Models\BaseModel;

class StockCategory extends BaseModel
{
    protected $table = 'stock_categories';

    protected $fillable = [
        'name',
    ];

}
