<?php
namespace App\Http\Controllers;

use App\Jobs\SendEmailVerificationCode;
use App\Jobs\SendPasswordResetMail;
use App\Models\CustomerOtp;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OnboardingController extends Controller
{

    public function verifyWithLink($token)
    {
        $user = User::where("token", $token)->first();
        if (isset($user)) {
            $user->email_verified_at = now();
            $user->token             = null;
            $user->save();

            $status = "Successful";

            return view("verification_status", compact("status"));
        } else {
            $status = "Failed";
            return view("verification_status", compact("status"));
        }
    }

    /**
     * Verify the One-Time Code sent to User for Email Verification
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

        $codeIsValid = CustomerOtp::where("otp_type", "email")->where("user_id", Auth::user()->id)->where("otp", $verificationCode)->first();

        if (! $codeIsValid) {
            toast("The provided verification code is invalid", 'error');
            return back();
        }

        if (now() > $codeIsValid->otp_expiration) {
            toast("The provided verification code has expired", 'error');
            return back();
        }

        if (! Auth::user()->update(['email_verified_at' => now()])) {
            toast("Something Went Wrong", 'error');
            return back();
        }

        if (! $codeIsValid->delete()) {
            toast("Something Went Wrong", 'error');
            return back();
        }

        toast("Email Verified Successfully", 'success');
        return redirect()->route("home");
    }

    /**
     * Send User Email Verification Code
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function sendVerificationMail(Request $request)
    {

        if (! $otp = CustomerOtp::updateOrCreate(
            [
                'user_id'  => Auth::user()->id,
                'otp_type' => 'email',
            ], [
                'otp'            => $this->generateOtp(),
                'otp_expiration' => Carbon::now()->addMinutes(5),
            ])) {
            return back();
        }

        SendEmailVerificationCode::dispatch($otp);

        return redirect()->route("home");

    }

    /**
     * Initiate User Password Reset
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

        $accountExist = User::where("email", $request->email)->where("status", "!=", "deleted")->first();

        if (! $accountExist) {
            toast("We could not find an account for the provided email", 'error');
            return back();
        }

        if (! $otp = CustomerOtp::updateOrCreate(
            [
                'user_id'  => $accountExist->id,
                'otp_type' => 'reset',
            ], [
                'otp'            => $this->generateOtp(),
                'otp_expiration' => Carbon::now()->addMinutes(5),
            ])) {
            toast("Something Went Wrong", 'error');
            return back();
        }

        SendPasswordResetMail::dispatch($otp);
        Session::put("email", $request->email);
        return redirect()->route("pwdResetConfirmation");

    }

    public function pwdResetConfirmation()
    {
        $email = Session::get("email");
        return view("auth.passwords.confirm", compact("email"));
    }

    /**
     * Verify the One-Time Code sent to User for Password Reset
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function passwordResetVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'   => 'required',
            'digit_1' => 'required',
            'digit_2' => 'required',
            'digit_3' => 'required',
            'digit_4' => 'required',
        ]);

        if ($validator->fails()) {
            toast("Please enter the complete confirmation code", 'error');
            return back();
        }

        $confirmationCode = $request->digit_1 . "" . $request->digit_2 . "" . $request->digit_3 . "" . $request->digit_4;

        $user = User::where("email", $request->email)->where("status", "!=", "deleted")->first();

        if (! $user) {
            toast("Something Went Wrong", 'error');
            return back();
        }

        $codeIsValid = CustomerOtp::where("otp_type", "reset")->where("user_id", $user->id)->where("otp", $confirmationCode)->first();

        if (! $codeIsValid) {
            toast("The provided password reset code is invalid", 'error');
            return back();
        }

        if (now() > $codeIsValid->otp_expiration) {
            toast("The provided password reset code has expired", 'error');
            return back();
        }

        if (! $codeIsValid->delete()) {
            toast("Something Went Wrong", 'error');
            return back();
        }

        Session::put("email", $request->email);
        return redirect()->route("newPassword");
    }

    public function newPassword()
    {
        $email = Session::get("email");
        return view("auth.passwords.reset", compact("email"));
    }

    /**
     * Verify the One-Time Code sent to User for Password Reset
     *
     * @param Request request
     *
     * @return JsonResponse
     */
    public function createNewPassword(Request $request)
    {
        $validator = $this->validate($request, [
            'email'                 => 'required',
            'password'              => 'required',
            'password_confirmation' => 'required',
        ]);

        $user = User::where("email", $request->email)->where("status", "!=", "deleted")->first();

        if (! $user) {
            toast("Something Went Wrong", 'error');
            return back();
        }

        if ($request->password != $request->password_confirmation) {
            toast("Your newly seleted passwords do not match.", 'error');
            return back();
        } else {
            $user->password = Hash::make($request->password);
            if (! $user->save()) {
                toast("Something Went Wrong", 'error');
                return back();
            }
        }

        toast("Password Changed Successfully", 'success');
        return redirect("/login");

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
