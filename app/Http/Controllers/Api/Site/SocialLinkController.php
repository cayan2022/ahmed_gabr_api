<?php

namespace App\Http\Controllers\Api\Site;

use App\Models\SocialLink;
use App\Http\Controllers\Controller;
use App\Http\Resources\SocialLinkResource;

class SocialLinkController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  SocialLink  $social_link
     * @return SocialLinkResource
     */
    public function __invoke(SocialLink $social_link): SocialLinkResource
    {
        return $social_link->getResource();
    }
}