<?php

namespace AIGenerate\Models\TextGenerate;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class TextGenerateExport extends BaseModel
{
    protected $table = 'text_generate_exports';

    public function generate(): BelongsTo
    {
        return $this->belongsTo(TextGenerate::class, 'text_generate_id', 'id');
    }

}
