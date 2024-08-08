<?php

namespace AIGenerate\Models\Prompt;

use App\Services\Point\Contracts\Payable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;

class PromptGenerate extends BaseModel implements Payable
{
    protected $table = 'prompt_generates';
    protected $with = [
        'prompt',
    ];

    public function scopeEnabled($query)
    {
        return $query->where('expired_at', '>', now());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prompt(): BelongsTo
    {
        return $this->belongsTo(Prompt::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(PromptGenerateOption::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(PromptGenerateResult::class);
    }

    public function getPointToBePaid(): float
    {
        return $this->price;
    }

    public function getPointPerToken(): float
    {
        return $this->prompt->getPointPerToken($this->image_size);
    }

}
