<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerificationCode;
use App\Models\Artisans;
use App\Models\Business;
use App\Models\Customer;
use App\Models\CustomerOtp;
use App\Models\CustomerWallet;
use App\Models\NotificationSetting;
use App\Models\Referral;
use App\Models\ReferralTransaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnboardingController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * Creates a new customer account
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:customers',
            'password' => 'required',
        ]);

        if (!Customer::create($validator)) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        if (!$token = auth()->attempt($validator)) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'We could not authenticate the user with the provided credentials',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'customer_data' => auth()->user(),
                ],
            ],
        ], 200);

    }

    /**
     * Send Customer Email Verification Code
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function sendVerificationMail(Request $request)
    {

        if (!$otp = CustomerOtp::updateOrCreate(
            [
                'customer_id' => Auth::user()->id,
                'otp_type' => 'email',
            ], [
                'otp' => $this->generateOtp(),
                'otp_expiration' => Carbon::now()->addMinutes(5),
            ])) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        SendEmailVerificationCode::dispatch($otp);

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'message' => "Verification Mail Sent Successfully",
                ],
            ],
        ], 200);

    }

    /**
     * Verify the One-Time Code sent to Customer for Email Verification
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function verifyEmail(Request $request)
    {
        $validator = $this->validate($request, [
            'verification_code' => 'required',
        ]);

        $codeIsValid = CustomerOtp::where("otp_type", "email")->where("customer_id", Auth::user()->id)->where("otp", $request->verification_code)->first();

        if (!$codeIsValid) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'The provided verification code is invalid',
                ],
            ], 400);
        }

        if (now() > $codeIsValid->otp_expiration) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'The provided verification code has expired',
                ],
            ], 400);
        }

        if (!$codeIsValid->delete()) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        if (!Auth::user()->update(['email_verified_at' => now()])) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        //Create Referral Wallet
        // $referralWallet = new ReferralWallet;
        // $referralWallet->customer_id = Auth::user()->id;
        // $referralWallet->save();

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'message' => 'Email Verified Successfully',
                ],
            ],
        ], 200);
    }

    /**
     * selectAccountType
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function selectAccountType(Request $request)
    {
        $validator = $this->validate($request, [
            'account_type' => 'required',
        ]);

        if ($request->account_type != 'business' && $request->account_type != 'artisan') {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => "Account Type must be 'business' or 'artisan'",
                ],
            ], 400);
        }

        if (!Auth::user()->update(['account_type' => $request->account_type])) {

            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        $notSet = NotificationSetting::updateOrCreate(
            [
                'customer_id' => Auth::user()->id,
            ], [
                'push_notification' => 1,
                'email_notification' => 1,
            ]);

        if (Auth::user()->account_type == "business") {
            $busSet = Business::updateOrCreate(
                [
                    'customer_id' => Auth::user()->id,
                ],
            );

            $referral = Referral::where("referral_id", Auth::user()->id)->whereNull("referral_type")->first();
            if (isset($referral)) {
                try {
                    DB::beginTransaction();
                    $referral->referral_type = "business";
                    $referral->bonus_received = $this->getReferralBonus(Auth::user()->account_type);
                    $referral->save();

                    $customerWallet = CustomerWallet::where("customer_id", $referral->customer_id)->first();
                    $customerWallet->referral_points = (double) ($customerWallet->referral_points + $referral->bonus_received);
                    $customerWallet->save();

                    $transaction = new ReferralTransaction;
                    $transaction->customer_id = $referral->customer_id;
                    $transaction->trx_type = "credit";
                    $transaction->amount = $referral->bonus_received;
                    $transaction->details = "Referral Bonus Received";
                    $transaction->save();

                    DB::commit();
                } catch (\Exception $e) {
                    report($e);
                    DB::rollback();
                }

            }
        } else {
            $artisan = Artisans::updateOrCreate(
                [
                    'customer_id' => Auth::user()->id,
                ],
            );

            $referral = Referral::where("referral_id", Auth::user()->id)->whereNull("referral_type")->first();
            if (isset($referral)) {
                try {
                    DB::beginTransaction();
                    $referral->referral_type = "artisan";
                    $referral->bonus_received = $this->getReferralBonus(Auth::user()->account_type);
                    $referral->save();

                    $customerWallet = CustomerWallet::where("customer_id", $referral->customer_id)->first();
                    $customerWallet->referral_points = (double) ($customerWallet->referral_points + $referral->bonus_received);
                    $customerWallet->save();

                    $transaction = new ReferralTransaction;
                    $transaction->customer_id = $referral->customer_id;
                    $transaction->trx_type = "credit";
                    $transaction->amount = $referral->bonus_received;
                    $transaction->details = "Referral Bonus Received";
                    $transaction->save();

                    DB::commit();
                } catch (\Exception $e) {
                    report($e);
                    DB::rollback();
                }
            }
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'account_details' => Auth::user(),
                ],
            ],
        ], 200);

    }

    /**
     * Generate a 4-digit One-Time Code
     *
     * @param null
     *
     * @return String $otp
     */
    public function generateOtp()
    {
        $pin = range(0, 9);
        $set = shuffle($pin);
        $otp = "";
        for ($i = 0; $i < 4; $i++) {
            $otp = $otp . "" . $pin[$i];
        }

        return $otp;
    }

    /**
     * getReferralBonus
     *
     * @param mixed accountType
     *
     * @return void
     */
    public function getReferralBonus($accountType)
    {
        if ($accountType == "business") {
            return (double) 40.00;
        } else {
            return (double) 20.00;
        }
    }

}
