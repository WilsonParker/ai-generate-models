<?php

namespace AIGenerate\Models\Prompt;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class PromptView extends BaseModel
{
    protected $table = 'prompt_view';

    public function prompt(): BelongsTo
    {
        return $this->belongsTo(Prompt::class, 'prompt_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
