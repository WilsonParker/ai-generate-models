<?php

namespace AIGenerate\Models\Prompt;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class PromptGenerateOption extends BaseModel
{
    protected $table = 'prompt_generate_options';

    public function generate(): BelongsTo
    {
        return $this->belongsTo(PromptGenerate::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(PromptOption::class, 'prompt_option_id');
    }
}
