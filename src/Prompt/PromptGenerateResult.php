<?php

namespace AIGenerate\Models\Prompt;

use App\Services\Point\Contracts\HasPointToBePaid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;

class PromptGenerateResult extends BaseModel implements HasPointToBePaid
{
    protected $table = 'prompt_generate_results';
    protected $with = [
        'generate',
    ];
    protected $fillable = [
        'result',
        'expired_at',
    ];

    public function generate(): BelongsTo
    {
        return $this->belongsTo(PromptGenerate::class, 'prompt_generate_id', 'id');
    }

    public function getPointToBePaid(): float
    {
        return $this->generate->getPointToBePaid();
    }

    public function getTotalTokens(): int
    {
        return $this->getResultUsage()['total_tokens'];
    }

    public function getResultUsage(): array
    {
        return $this->getResultJson()['usage'];
    }

    public function getResultJson(): array
    {
        return json_decode($this->result, true);
    }

    public function getCompletionToken(): int
    {
        return $this->getResultUsage()['completion_tokens'];
    }

    public function getPromptToken(): int
    {
        return $this->getResultUsage()['prompt_tokens'];
    }
}
