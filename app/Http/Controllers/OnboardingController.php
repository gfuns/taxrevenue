<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailVerificationCode;
use App\Models\CustomerOtp;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OnboardingController extends Controller
{
    /**
     * Verify the One-Time Code sent to Customer for Email Verification
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'digit_1' => 'required',
            'digit_2' => 'required',
            'digit_3' => 'required',
            'digit_4' => 'required',
        ]);

        if ($validator->fails()) {
            toast("Please enter the complete verification code", 'error');
            return back();
        }

        $verificationCode = $request->digit_1 . "" . $request->digit_2 . "" . $request->digit_3 . "" . $request->digit_4;

        $codeIsValid = CustomerOtp::where("otp_type", "email")->where("customer_id", Auth::user()->id)->where("otp", $verificationCode)->first();

        if (!$codeIsValid) {
            toast("The provided verification code is invalid", 'error');
            return back();
        }

        if (now() > $codeIsValid->otp_expiration) {
            toast("The provided verification code has expired", 'error');
            return back();
        }

        if (!$codeIsValid->delete()) {
            toast("Something Went Wrong", 'error');
            return back();
        }

        if (!Auth::user()->update(['email_verified_at' => now()])) {
            toast("Something Went Wrong", 'error');
            return back();
        }

        toast("Email Verified Successfully", 'success');
        return redirect()->route("home");
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
            return back();
        }

        SendEmailVerificationCode::dispatch($otp);

        return redirect()->route("home");

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
}
