<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Models\SocialLink;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dashboard\UpdateSocialLinkRequest;

class SocialLinkController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialLink  $social_link
     * @return \App\Http\Resources\SocialLinkResource
     */
    public function show(SocialLink $social_link)
    {
        return $social_link->getResource();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Dashboard\UpdateSocialLinkRequest  $request
     * @param  \App\Models\SocialLink  $social_link
     * @return \App\Http\Resources\SocialLinkResource
     */
    public function update(UpdateSocialLinkRequest $request, SocialLink $social_link)
    {
        $social_link->update($request->validated());

        return $social_link->getResource();
    }
}