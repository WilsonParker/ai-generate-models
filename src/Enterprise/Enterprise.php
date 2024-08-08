<?php

namespace AIGenerate\Models\Enterprise;

use AIGenerate\Models\BaseModel;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Enterprise extends BaseModel implements HasMedia
{
    use HasTags, InteractsWithMedia;

    protected $table = 'enterprises';

    public function clients(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(EnterpriseClient::class, EnterpriseClientPivot::class, 'enterprise_id', 'id', 'id', 'enterprise_client_id');
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
