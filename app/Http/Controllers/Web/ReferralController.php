<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CustomerWallet;
use App\Models\Referral;
use Auth;
use Illuminate\Http\JsonResponse;

class ReferralController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * viewReferrals
     *
     * @return void
     */
    public function viewReferrals()
    {
        $referrals = Referral::orderBy("id", 'desc')->where("customer_id", Auth::user()->id)->whereNotNull("referral_type")->get();

        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'referrals' => $referrals,
            ],
        ], 200);
    }

    /**
     * referralLink
     *
     * @return void
     */
    public function referralLink()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'referral_link' => "https://areteplanet.com/invite?ref=" . Auth::user()->referral_code,
            ],
        ], 200);
    }

    /**
     * referralStats
     *
     * @return void
     */
    public function referralStats()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'referral_points' => CustomerWallet::where("customer_id", Auth::user()->id)->first()->referral_points,
                'total_referrals' => Referral::where("customer_id", Auth::user()->id)->whereNotNull("referral_type")->count(),
                'verified_referrals' => Referral::where("customer_id", Auth::user()->id)->where("verified", 1)->whereNotNull("referral_type")->count(),
            ],
        ], 200);
    }

/**
 * referralDetails
 *
 * @return void
 */

    public function referralDetails()
    {

        $referrals = Referral::orderBy("id", 'desc')->where("customer_id", Auth::user()->id)->whereNotNull("referral_type")->get();

        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'referral_link' => "https://areteplanet.com/invite?ref=" . Auth::user()->referral_code,
                'referral_points' => CustomerWallet::where("customer_id", Auth::user()->id)->first()->referral_points,
                'total_referrals' => Referral::where("customer_id", Auth::user()->id)->whereNotNull("referral_type")->count(),
                'verified_referrals' => Referral::where("customer_id", Auth::user()->id)->where("verified", 1)->whereNotNull("referral_type")->count(),
            ],
            'referrals' => $referrals,
        ], 200);
    }
}
