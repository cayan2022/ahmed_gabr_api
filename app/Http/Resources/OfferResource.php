<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = [];
        foreach ($this->getAllImages() as $image) {
            $images[] = $image->original_url;
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'discount_percentage' => $this->discount_percentage,
            'url' => $this->url ?? null,
            'is_block' => $this->is_block,
            'image' => $this->getAvatar(),
            'images' => $images,
            'translations' => $this->getTranslationsArray()
        ];
    }
}
