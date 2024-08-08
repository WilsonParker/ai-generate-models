<?php

namespace AIGenerate\Models\Prompt;

use App\Services\Image\Contracts\HasImages;
use App\Services\Image\Contracts\HasThumbnail;
use App\Services\Image\Contracts\Imageable;
use App\Services\Image\Models\Image;
use App\Services\Image\Models\Media;
use App\Services\Point\Contracts\Payable;
use App\Services\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use AIGenerate\Models\BaseModel;
use AIGenerate\Models\Prompt\Enums\Status;
use AIGenerate\Models\User\User;
use AIGenerate\Services\AI\OpenAI\Chat\Models;
use AIGenerate\Services\AI\OpenAI\Contracts\HasOpenAIType;
use AIGenerate\Services\AI\OpenAI\Enums\OpenAITypes;
use AIGenerate\Services\AI\OpenAI\Images\ImageSize;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\IsSorted;

class Prompt extends BaseModel implements HasOpenAIType, Imageable, Payable, HasThumbnail, HasMedia, HasImages
{
    use HasFactory, InteractsWithMedia, IsSorted;

    protected $with = ['options', 'fillableOptions', 'thumbnail', 'images', 'categories', 'tags'];

    public function scopeEnabled(Builder $query): void
    {
        $query->where('prompt_status_code', Status::Enabled->value);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PromptType::class, 'prompt_type_code', 'code');
    }

    public function engine(): HasOne
    {
        return $this->hasOne(PromptEngine::class, 'prompt_engine_code', 'code');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PromptCategory::class, PromptCategoryPivot::class);
    }

    public function status(): HasOne
    {
        return $this->hasOne(PromptStatus::class, 'code', 'prompt_status_code');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fillableOptions(): HasMany
    {
        return $this->options()->whereNull('value');
    }

    public function options(): HasMany
    {
        return $this->hasMany(PromptOption::class);
    }

    public function filledOptions(): HasMany
    {
        return $this->options()->whereNotNull('value');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function generates(): HasMany
    {
        return $this->hasMany(PromptGenerate::class);
    }

    public function otherPrompts(): HasMany
    {
        return $this->hasMany(Prompt::class, 'user_id', 'user_id')->where('id', '!=', $this->id);
    }

    public function count(): HasOne
    {
        return $this->hasOne(PromptCount::class);
    }

    public function getImageableType(): string
    {
        return $this->getMorphClass();
    }

    public function getMorphClass(): string
    {
        return 'prompt';
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
        return 'prompt_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        // Customize the data array...
        $generated = $this->count ? $this->count->generated : 0;
        $views = $this->count ? $this->count->views : 0;
        return array_merge(
            $this->only([
                'title',
                'description',
                'created_at',
                'updated_at',
            ]),
            [
                'user_email' => $this->user->email,
                'user_name' => $this->user->name,
                'type' => $this->type->getKey(),
                'categories' => $this->categories->pluck('id')->toArray(),
                'generated' => $generated,
                'views' => $views,
                'hottest' => $views + $generated * 100,
                'relevance' => $views + $generated * 100,
                'top' => $generated * $this->price_per_generate,
            ]
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
        return $this->prompt_status_code;
    }

    public function isCreating(): bool
    {
        return $this->getStatusCode() === Status::Creating->value;
    }

    public function isWaiting(): bool
    {
        return $this->getStatusCode() === Status::Waiting->value;
    }

    public function isBlocked(): bool
    {
        return $this->getStatusCode() === Status::Blocked->value;
    }

    public function getPointToBePaid(): float
    {
        return $this->price_per_generate;
    }

    public function getPointPerToken(string $size = null): float
    {
        switch ($this->getOpenAIType()) {
            case OpenAITypes::Image :
                $size = ImageSize::from($size);
                return $size->perToken();
            case OpenAITypes::Chat :
                return Models::from($this->prompt_engine_code)->perToken();
            case OpenAITypes::Completion:
                return \AIGenerate\Services\AI\OpenAI\Completion\Models::from($this->prompt_engine_code)->perToken();
            default :
                return 0;
        }
    }

    public function getOpenAIType(): OpenAITypes
    {
        return OpenAITypes::from($this->type->code);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'gallery', 'model_type', 'model_id', 'id');
    }

    public function thumbnail(): MorphOne
    {
        return $this->morphOne(Media::class, 'gallery', 'model_type', 'model_id', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
             ->useFallbackUrl(config('constant.images.default'))
             ->registerMediaConversions(function (Media $media) {
                 $this
                     ->addMediaConversion('gallery-thumbnail')
                     ->format(Manipulations::FORMAT_WEBP)
                     ->width(368)
                     ->height(232);
             });
    }

    public function getThumbnail(): Image
    {
        return $this->thumbnail;
    }

    public function getImages(): Collection
    {
        return $this->images;
    }
}
