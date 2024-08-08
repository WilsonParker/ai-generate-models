<?php

namespace AIGenerate\Models\Blog;

use AIGenerate\Models\BaseModel;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Blog extends BaseModel implements HasMedia
{
    use HasTags, InteractsWithMedia;

    protected $table = 'blogs';

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlogAuthor::class, 'blog_author_id', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('gallery-thumbnail')
            ->format(Manipulations::FORMAT_WEBP)
            ->width(512)
            ->height(322);
    }
}
