<?php

namespace AIGenerate\Models\Stock;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\Stock\Enums\Status;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\IsSorted;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Stock extends BaseModel implements HasMedia
{
    use InteractsWithMedia, IsSorted;

    protected $table = 'stocks';

    protected $with = ['information', 'recommend'];

    public function scopeEnabled(Builder $query): void
    {
        $query->where('stock_status_code', Status::Enabled->value);
    }

    public function origin(): HasOne
    {
        return $this->hasOne(\App\Models\Stock\AI\Stock::class, 'id', 'id');
    }

    public function recommend(): HasOne
    {
        return $this->hasOne(StockRecommend::class);
    }

    public function count(): HasOne
    {
        return $this->hasOne(StockCount::class);
    }

    public function status(): HasOne
    {
        return $this->hasOne(StockStatus::class, 'code', 'stock_status_code');
    }

    public function keywords(): HasManyThrough
    {
        return $this->hasManyThrough(
            StockKeyword::class,
            StockKeywordPivot::class,
            'stock_id',
            'id',
            'id',
            'stock_keyword_id',
        );
    }

    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(
            StockCategory::class,
            StockCategoryPivot::class,
            'stock_id',
            'id',
            'id',
            'stock_category_id',
        );
    }

    public function information(): HasOne
    {
        return $this->hasOne(StockInformation::class, 'stock_id', 'id');
    }

    public function generates(): HasMany
    {
        return $this->hasMany(StockGenerate::class, 'stock_id', 'id');
    }

    public function getImageableType(): string
    {
        return $this->getMorphClass();
    }

    public function getMorphClass(): string
    {
        return 'stock';
    }

    public function getImageableId()
    {
        return $this->getKey();
    }

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'stock_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        // Customize the data array...
        return array_merge(
            $this->only([
                            'title',
                            'description',
                            'created_at',
                            'updated_at',
                        ]),
            [
                'ethnicity' => $this->information->ethnicity,
                'gender' => $this->information->gender,
                'hottest' => $this->count ? $this->count->views : 0,
                'top' => $this->count ? $this->count->generates : 0,
            ],
        );
    }

    /**
     * Determine if the model should be searchable.
     */
    public function shouldBeSearchable(): bool
    {
        return $this->isEnabled();
    }

    public function isEnabled(): bool
    {
        return $this->getStatusCode() === Status::Enabled->value;
    }

    private function getStatusCode(): string
    {
        return $this->stock_status_code ?? Status::Creating->value;
    }

    public function detailImage(): MorphOne
    {
        return $this->morphOne(Media::class, 'detail', 'model_type', 'model_id', 'id')
                    ->where('collection_name', 'detail');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'gallery', 'model_type', 'model_id', 'id');
    }

    public function getThumbnailUrl(): string
    {
        return $this->images->first()?->getUrl('gallery-thumbnail') ?? config('constant.images.default');
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

        $this->addMediaCollection('detail')
             ->useFallbackUrl(config('constant.images.default') ?? '')
             ->registerMediaConversions(function (Media $media) {
                 $this
                     ->addMediaConversion('detail-thumbnail')
                     ->format(Manipulations::FORMAT_WEBP)
                     ->width(512)
                     ->height(322);
             });
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(StockReview::class);
    }
}
