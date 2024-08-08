<?php

namespace AIGenerate\Models\Prompt;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class PromptCount extends BaseModel
{
    protected $table = 'prompt_count';

    public function prompt(): BelongsTo
    {
        return $this->belongsTo(Prompt::class, 'prompt_id', 'id');
    }

}
