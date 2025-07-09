<?php
namespace App\Http\Controllers;

use App\Mail\AuthenticationOTP as AuthenticationOTP;
use App\Mail\BusinessCreationMail as BusinessCreationMail;
use App\Mail\LoginNotification as LoginNotification;
use App\Mail\VerificationMail as VerificationMail;
use App\Models\CustomerOtp;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Jenssegers\Agent\Facades\Agent;
use Mail;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == "Business") {

            try {
                if (Auth::user()->auth_2fa == "Email") {
                    if ($otp = CustomerOtp::updateOrCreate(
                        [
                            'user_id'  => Auth::user()->id,
                            'otp_type' => Auth::user()->auth_2fa,
                        ], [
                            'otp'            => $this->generateTFA(),
                            'otp_expiration' => Carbon::now()->addMinutes(10),
                        ])) {

                        $user = Auth::user();
                        Mail::to($user)->send(new AuthenticationOTP($user, $otp));

                    }

                }

            } catch (\Exception $e) {
                report($e);
            } finally {
                return redirect()->route("business.dashboard");
            }

            if (Auth::user()->profile_updated == 1) {
                return redirect()->route("business.dashboard");
            } else {
                return redirect()->route("business.viewProfile");
            }

        } else {
            if (Auth::user()->profile_updated == 1) {
                return redirect()->route("admin.dashboard");
            } else {
                return redirect()->route("business.viewProfile");
            }
        }
    }

    public function welcome()
    {
        try {

            if ($otp = CustomerOtp::updateOrCreate(
                [
                    'user_id'  => Auth::user()->id,
                    'otp_type' => "email",
                ], [
                    'otp'            => $this->generateOtp(),
                    'otp_expiration' => Carbon::now()->addMinutes(10),
                ])) {

                $user = Auth::user();
                Mail::to($user)->send(new BusinessCreationMail($user));
                Mail::to($user)->send(new VerificationMail($user, $otp->otp));

            }

        } catch (\Exception $e) {
            report($e);
        } finally {
            return redirect()->route("home");
        }
    }

    public function authy()
    {
        try {
            $user       = Auth::user();
            $platform   = Agent::platform();
            $ip         = "172.70.231.54"; //request()->ip();
            $location   = Location::get($ip);
            $deviceInfo = [
                "device"     => $platform . "-" . Agent::version($platform),
                "browser"    => Agent::browser(),
                "ip_address" => $location->ip,
                "location"   => $location->countryName,
            ];

            Mail::to($user)->send(new LoginNotification($user, $deviceInfo));
        } catch (\Exception $e) {
            report($e);
        } finally {
            return redirect()->route("home");
        }
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

    public function generateTFA()
    {
        $pin = range(0, 9);
        $set = shuffle($pin);
        $otp = "";
        for ($i = 0; $i < 6; $i++) {
            $otp = $otp . "" . $pin[$i];
        }

        return $otp;
    }

}
