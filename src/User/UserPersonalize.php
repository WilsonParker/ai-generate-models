<?php

namespace AIGenerate\Models\User;

use Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use AIGenerate\Models\BaseModel;

class UserPersonalize extends BaseModel
{
    use SoftDeletes;

    protected $table = 'user_personalize';

    protected $fillable = [
        'user_id',
        'type',
        'pronoun',
        'interest',
        'birth',
    ];

    protected $casts = [
        'interest' => 'array',
    ];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function interest(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
