<?php

namespace App\Http\Requests\Api\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSocialLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'snapchat' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'youtube' => 'nullable|url',
            'whatsapp' => 'nullable',
            'email' => ['nullable', 'email:rfc,dns'],
            'phone_1' => 'nullable',
            'phone_2' => 'nullable',
            'location_name' => 'nullable',
            'location_link' => 'nullable|url',
        ];
    }
}