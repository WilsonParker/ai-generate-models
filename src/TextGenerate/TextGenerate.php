<?php

namespace AIGenerate\Models\TextGenerate;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\User\User;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TextGenerate extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'text_generates';

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->useFallbackUrl(config('constant.images.default') ?? '')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('gallery-thumbnail')
                    ->format(Manipulations::FORMAT_WEBP)
                    ->width(512)
                    ->height(322);
            });
    }

    public function getMorphClass(): string
    {
        return 'text-generates';
    }
}
