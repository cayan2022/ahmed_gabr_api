<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Resources\SocialLinkResource;

class SocialLink extends Model
{
    use HasFactory;

    /**
     * @return SocialLinkResource
     */
    public function getResource(): SocialLinkResource
    {
        return new SocialLinkResource($this->fresh());
    }

    protected $fillable = [
        'facebook',
        'twitter',
        'instagram',
        'snapchat',
        'linkedin',
        'tiktok',
        'youtube',
        'whatsapp',
        'email',
        'phone_1',
        'phone_2',
        'location_name',
        'location_link',
    ];
}