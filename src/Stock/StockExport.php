<?php

namespace AIGenerate\Models\Stock;

use AIGenerate\Models\BaseModel;

class StockExport extends BaseModel
{
    protected $table = 'stock_exports';

    public function generate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StockGenerate::class, 'stock_generate_id', 'id');
    }

}
