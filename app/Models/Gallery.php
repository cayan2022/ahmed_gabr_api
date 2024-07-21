<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use App\Http\Filters\GalleryFilter;
use App\Http\Resources\GalleryResource;
use App\Models\Traits\HasActivation;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Gallery extends Model implements HasMedia, TranslatableContract
{
    use HasFactory, InteractsWithMedia, Translatable, Filterable, HasActivation;

    protected $fillable = [
        'is_block','type'
    ];
    protected $casts=[
        'is_block' => 'boolean',
    ];
    public $translatedAttributes = ['title','description'];
    public const MEDIA_COLLECTION_NAME = 'gallery_media';
    public const MEDIA_COLLECTION_NAME_COVER = 'gallery_media_cover';
    public const MEDIA_COLLECTION_URL = 'images/gallery.png';

    protected $filter= GalleryFilter::class;

    /*helpers*/
    /**
     * @return GalleryResource
     */
    public function getResource(): GalleryResource
    {
        return new GalleryResource($this->fresh());
    }
    public function getGallery()
    {
        return $this->getFirstMediaUrl(self::MEDIA_COLLECTION_NAME);
    }

    public function getCover()
    {
        return $this->getFirstMediaUrl(self::MEDIA_COLLECTION_NAME_COVER);
    }

    public function getAllMediaGallery()
    {
        return $this->getMedia(self::MEDIA_COLLECTION_NAME);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION_NAME)
            ->useFallbackUrl(asset(self::MEDIA_COLLECTION_URL))
            ->useFallbackPath(asset(self::MEDIA_COLLECTION_URL));
    }
}
