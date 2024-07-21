<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'is_block'=>$this->is_block,
            'type'=>$this->type,
            'link'=>$this->link,
            'media'=>$this->getGallery(),
            'cover'=>$this->getCover(),
            'all_media'=>$this->getAllMediaGallery(),
            'translations'=> $this->getTranslationsArray()
        ];
    }
}
