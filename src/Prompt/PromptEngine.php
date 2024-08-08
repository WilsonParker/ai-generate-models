<?php

namespace AIGenerate\Models\Prompt;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseCodeModel;

class PromptEngine extends BaseCodeModel
{
    use SoftDeletes;

    protected $table = 'prompt_engines';

    public function type(): BelongsTo
    {
        return $this->belongsTo(PromptType::class);
    }
}
