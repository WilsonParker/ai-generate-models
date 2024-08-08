<?php

namespace AIGenerate\Models\Stock;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use AIGenerate\Models\BaseModel;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class StockGenerate extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'stock_generates';

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'gallery', 'model_type', 'model_id', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->useFallbackUrl(config('constant.images.default') ?? '')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('gallery-thumbnail')
                    ->format(Manipulations::FORMAT_WEBP)
                    ->width(368)
                    ->height(232);
            });
    }

    public function getMorphClass(): string
    {
        return 'stock-generates';
    }
}
