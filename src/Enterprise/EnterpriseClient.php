<?php

namespace AIGenerate\Models\Enterprise;

use AIGenerate\Models\BaseModel;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EnterpriseClient extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    
    protected $table = 'enterprise_clients';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('gallery-thumbnail')
            ->format(Manipulations::FORMAT_WEBP)
            ->width(368)
            ->height(232);
    }
}
