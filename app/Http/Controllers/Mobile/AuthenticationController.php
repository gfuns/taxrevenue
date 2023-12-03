<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Jobs\SendPasswordResetMail;
use App\Models\Customer;
use App\Models\CustomerOtp;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * Authenticate an existing Customer
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required|',
            'password' => 'required',
        ]);

        $userExist = Customer::where("email", $request->email)->where("status", "!=", "deleted")->first();

        if (!$userExist) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Authentication Failed',
                    'details' => 'We could not find a user with the provided credentials',
                ],
            ], 400);
        }

        if (!$token = auth()->attempt($validator)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Authentication Failed',
                    'details' => 'We could not authenticate the user with the provided credentials',
                ],
            ], 400);
        }

        if (Auth::user()->account_type == "merchant") {
            return new JsonResponse([
                'token' => $token,
                'token_type' => 'Bearer',
                'customer_data' => Auth::user(),
                'merchant_data' => Auth::user()->merchant,
            ], 200);
        } else {
            return new JsonResponse([
                'token' => $token,
                'token_type' => 'Bearer',
                'customer_data' => Auth::user(),
            ], 200);
        }

    }

    /**
     * Initiate Customer Password Reset
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function initiatePasswordReset(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required|',
        ]);

        $accountExist = Customer::where("email", $request->email)->where("status", "!=", "deleted")->first();

        if (!$accountExist) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Initiating Password Reset Failed',
                    'details' => 'We could not find an account for the provided email',
                ],
            ], 400);
        }

        if (!$otp = CustomerOtp::updateOrCreate(
            [
                'customer_id' => $accountExist->id,
                'otp_type' => 'reset',
            ], [
                'otp' => $this->generateOtp(),
                'otp_expiration' => Carbon::now()->addMinutes(5),
            ])) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Initiating Password Reset Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        SendPasswordResetMail::dispatch($otp);

        return new JsonResponse([
            'message' => "Password Reset Mail Sent Successfully",
        ], 200);

    }

    /**
     * Verify the One-Time Code sent to Customer for Password Reset
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function passwordResetVerification(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required',
            'verification_code' => 'required',
        ]);

        $customer = Customer::where("email", $request->email)->where("status", "!=", "deleted")->first();

        if (!$customer) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Password Reset Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        $codeIsValid = CustomerOtp::where("otp_type", "reset")->where("customer_id", $customer->id)->where("otp", $request->verification_code)->first();

        if (!$codeIsValid) {
            return new JsonResponse([
                'response' => [
                    'message' => 'The provided password reset code is invalid',
                ],
            ], 400);
        }

        if (now() > $codeIsValid->otp_expiration) {
            return new JsonResponse([
                'response' => [
                    'message' => 'The provided password reset code has expired',
                ],
            ], 400);
        }

        if (!$codeIsValid->delete()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Password Reset Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'The provided password reset code was successfully verified',
            ],
        ], 200);
    }

    /**
     * Verify the One-Time Code sent to Customer for Password Reset
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function createNewPassword(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $customer = Customer::where("email", $request->email)->where("status", "!=", "deleted")->first();

        if (!$customer) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Change Password',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        $customer->password = Hash::make($request->password);
        if (!$customer->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Change Password',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Password Changed Successfully',
            ],
        ], 200);

    }

    /**
     * Generate a 6-digit One-Time Code
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
