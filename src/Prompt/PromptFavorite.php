<?php

namespace AIGenerate\Models\Prompt;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class PromptFavorite extends BaseModel
{
    protected $table = 'prompt_favorites';
    protected $with = ['prompt'];

    public function prompt(): BelongsTo
    {
        return $this->belongsTo(Prompt::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
