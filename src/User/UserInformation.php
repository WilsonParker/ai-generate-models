<?php

namespace AIGenerate\Models\User;

use App\Services\Image\Contracts\Imageable;
use App\Services\Image\Models\Image;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use AIGenerate\Models\BaseModel;

class UserInformation extends BaseModel implements Imageable
{
    protected $hidden = [
        'google_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable', $this->getImageableType());
    }

    public function getImageableType(): string
    {
        return 'user_information';
    }

    public function getImageableId()
    {
        return $this->getKey();
    }
}
