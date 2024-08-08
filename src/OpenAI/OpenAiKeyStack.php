<?php

namespace AIGenerate\Models\OpenAI;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class OpenAiKeyStack extends BaseModel
{
    protected $table = 'open_ai_key_stacks';
    protected $with = ['openAiKey'];

    public function openAiKey(): BelongsTo
    {
        return $this->belongsTo(OpenAiKey::class);
    }

    public function getApiKey(): string
    {
        return $this->openAiKey->key;
    }
}
