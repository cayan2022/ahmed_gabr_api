<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialLinkResource extends JsonResource
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
            'id' => $this->id,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'snapchat' => $this->snapchat,
            'linkedin' => $this->linkedin,
            'tiktok' => $this->tiktok,
            'youtube' => $this->youtube,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
            'location_name' => $this->location_name,
            'location_link' => $this->location_link,
        ];
    }
}