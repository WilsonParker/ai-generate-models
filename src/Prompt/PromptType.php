<?php

namespace AIGenerate\Models\Prompt;

use Illuminate\Database\Eloquent\Relations\HasMany;
use AIGenerate\Models\BaseCodeModel;

class PromptType extends BaseCodeModel
{
    protected $table = 'prompt_types';

    public function engines(): HasMany
    {
        return $this->hasMany(PromptEngine::class);
    }

    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class);
    }
}
