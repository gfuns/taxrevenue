<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\PlatformCategories;
use Auth;
use Illuminate\Http\JsonResponse;

class GeneralSettingsController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * Get Application Key
     *
     *
     * @return JsonResponse
     */
    public function getApplicationKey()
    {
        return new JsonResponse([
            'application_key' => GeneralSettings::appMobile()->setting_value,
        ], 200);
    }

    /**
     * Get Platform Information
     *
     *
     * @return JsonResponse
     */
    public function platformInfomation()
    {
        return new JsonResponse([
            'contact_details' => [
                'email' => GeneralSettings::where("setting", "contact_email")->first()->setting_value,
                'phone' => GeneralSettings::where("setting", "contact_phone")->first()->setting_value,
                'address' => GeneralSettings::where("setting", "contact_address")->first()->setting_value,
            ],
            'social_handles' => [
                'facebook' => GeneralSettings::where("setting", "facebook")->first()->setting_value,
                'twitter' => GeneralSettings::where("setting", "twitter")->first()->setting_value,
                'instagram' => GeneralSettings::where("setting", "instagram")->first()->setting_value,
                'youtube' => GeneralSettings::where("setting", "youtube")->first()->setting_value,
            ],
        ], 200);
    }

    public function platformCategories()
    {
        return new JsonResponse([
            'categories' => PlatformCategories::all(),
        ], 200);
    }
}
