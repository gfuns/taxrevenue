<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Customer;
use App\Models\JobListing;
use App\Models\NotificationSetting;
use App\Models\PlatformCategories;
use App\Models\JobApplication;
use App\Models\ReferralTransaction;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function dashboard()
    {
        $jobs = JobListing::where("customer_id", Auth::user()->business->id)->pluck("id");
        $param = [
            'jobsPosted' => JobListing::where("customer_id", Auth::user()->business->id)->count(),
            'totalApplicants' => JobApplication::whereIn("job_listing_id", $jobs)->count(),
            'areteBalance' => Auth::user()->wallet->arete_balance,
            'referralPoints' => Auth::user()->wallet->referral_points,
        ];

        $latestJobs = JobListing::orderBy("id", "desc")->where("customer_id", Auth::user()->business->id)->limit(5)->get();
        $latestApplications = JobApplication::orderBy("id", "desc")->whereIn("job_listing_id", $jobs)->limit(5)->get();
        $latestTransactions = ReferralTransaction::orderBy("id", "desc")->where("customer_id", Auth::user()->business->id)->limit(5)->get();
        return view("business.dashboard", compact("param", "latestJobs", "latestApplications", "latestTransactions"));
    }

    /**
     * profile
     *
     * @return void
     */
    public function viewProfile()
    {
        return view("business.profile");
    }

    /**
     * updateProfile
     *
     * @param Request request
     *
     * @return void
     */
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'country' => 'required',
        ]);

        $parseEmail = Customer::where("email", $request->email)->where("id", "!=", Auth::user()->id)->count();
        if ($parseEmail > 0) {
            toast('Email already taken by someone else.', 'error');
            return back();
        }

        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->country = $request->country;
        if ($request->has('profile_photo')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
            $user->photo = $uploadedFileUrl;
        }

        if ($user->save()) {
            toast('Profile Information Successfully Updated.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }

    }

    /**
     * changePassword
     *
     * @return void
     */
    public function changePassword()
    {
        return view("business.change_password");
    }

    /**
     * updatePassword
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            toast('Invalid current password provided.', 'error');
            return back();
        } else {
            if ($request->new_password != $request->new_password_confirmation) {
                toast('Your newly seleted passwords do not match.', 'error');
                return back();
            } else {
                $user->password = Hash::make($request->new_password);
                $user->save();
            }
        }

        if ($user->save()) {
            toast('Password Successfully Updated.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }

    }

    /**
     * businessProfile
     *
     * @return void
     */
    public function businessProfile()
    {
        $business = Business::where("customer_id", Auth::user()->id)->first();
        $categories = PlatformCategories::orderBy("category_name", "asc")->get();
        return view("business.business_information", compact("business", "categories"));
    }

    public function updateBusinessProfile(Request $request)
    {
        $validatedData = $request->validate([
            'business_name' => 'required',
            'business_category' => 'required',
            'business_description' => 'required',
            'business_phone' => 'required',
            'business_email' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'business_address' => 'required',
        ]);

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->business_name = $request->business_name;
        $business->slug = preg_replace("/ /", "-", strtolower($request->business_name));
        $business->category_id = $request->business_category;
        $business->business_category = PlatformCategories::find($request->business_category)->category_name;
        $business->country = $request->country;
        $business->state = $request->state;
        $business->city = $request->city;
        $business->street = $request->business_address;
        $business->business_address = $request->business_address;
        $business->business_description = $request->business_description;
        $business->business_phone = $request->business_phone;
        $business->business_email = $request->business_email;
        $business->website_url = $request->website_url;
        $business->facebook_url = $request->facebook_url;
        $business->twitter_url = $request->twitter_url;
        $business->instagram_url = $request->instagram_url;
        $business->linkedin_url = $request->linkedin_url;
        $business->visibility = 1;
        if ($request->has('business_logo')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('business_logo')->getRealPath())->getSecurePath();
            $business->business_logo = $uploadedFileUrl;
        }
        if ($business->save()) {
            toast('Business Information Successfully Updated.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    public function notificationSettings()
    {
        $notifications = NotificationSetting::where("customer_id", Auth::user()->id)->first();
        return view("business.notification_settings", compact("notifications"));
    }

    /**
     * toggleAllNotificationSettings
     *
     * @param Request request
     *
     * @return void
     */
    public function toggleAllNotificationSettings(Request $request)
    {

        NotificationSetting::where('customer_id', Auth::user()->id)->update([
            'unusual_activity' => $request->status,
            'new_browser_signin' => $request->status,
            'latest_news' => $request->status,
            'features_updates' => $request->status,
            'account_tips' => $request->status,
            'all_not' => $request->status,
        ]);

        return response()->json(['status' => 'Notification status changed successfully.']);
    }

    /**
     * toggleSpecificNotificationSettings
     *
     * @param Request request
     *
     * @return void
     */
    public function toggleSpecificNotificationSettings(Request $request)
    {

        NotificationSetting::where('customer_id', Auth::user()->id)->update([
            $request->param => $request->status,
        ]);

        return response()->json(['status' => 'Notification status changed successfully.']);

    }

    public function unsubscribeAllNotifications()
    {
        $notifications = NotificationSetting::where("customer_id", Auth::user()->id)->first();
        $notifications->unusual_activity = 0;
        $notifications->new_browser_signin = 0;
        $notifications->latest_news = 0;
        $notifications->features_updates = 0;
        $notifications->account_tips = 0;
        if ($notifications->save()) {
            toast('You have unsubscribed from all notifications.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    public function security()
    {
        $google2fa = app('pragmarx.google2fa');
        $google2faSecret = $google2fa->generateSecretKey();
        $QRImage = $google2fa->getQRCodeInline(
            env('APP_NAME'),
            Auth::user()->email,
            $google2faSecret
        );
        return view("business.security", compact("google2faSecret", "QRImage"));
    }

    public function enableGA(Request $request)
    {
        $gaCode = $request->google2fa_code;
        $gaSecret = $request->google2fa_secret;

        if ($gaCode == null || $gaSecret == null) {
            toast('Please enter a valid Google 2FA Code.', 'error');
            return back();
        }

        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');
        $valid = $google2fa->verifyKey($gaSecret, $gaCode);

        if ($valid) {
            $user->google2fa_secret = $gaSecret;
            if ($user->save()) {
                toast('Successfully Enabled Google Authenticator on your account', 'success');
                return back();
            } else {
                toast('Something went wrong.', 'error');
                return back();
            }

        } else {
            toast('Invalid Google 2FA Code.', 'error');
            return back();

        }

    }

    public function select2FA(Request $request)
    {

        $user = Auth::user();

        if ($request->param == "google_auth2fa") {
            if (isset($user->google2fa_secret) && $request->status == 1) {
                $user->auth_2fa = "GoogleAuth";
            } else if (isset($user->google2fa_secret) && $request->status == 0) {
                $user->auth_2fa = null;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please Setup Google Authenticator to be able to enable this option.',
                ]);
            }
        }

        if ($request->param == "email_auth2fa") {
            if ($request->status == 1) {
                $user->auth_2fa = "Email";
            } else {
                $user->auth_2fa = null;
            }
        }

        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Authentication 2FA Method Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again',
            ]);
        }

    }

    public function selectWithdrawalConfirmation(Request $request)
    {

        $user = Auth::user();

        if ($request->param == "google_withdrawal") {
            if (isset($user->google2fa_secret) && $request->status == 1) {
                $user->withdrawal_confirmation = "GoogleAuth";
            } else if (isset($user->google2fa_secret) && $request->status == 0) {
                $user->withdrawal_confirmation = null;
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please Setup Google Authenticator to be able to enable this option.',
                ]);
            }
        }

        if ($request->param == "email_withdrawal") {
            if ($request->status == 1) {
                $user->withdrawal_confirmation = "Email";
            } else {
                $user->withdrawal_confirmation = null;
            }
        }

        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Withdrawal Confirmation Method Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again',
            ]);
        }

    }

    public function deleteAccount()
    {
        return view("business.delete_account");
    }

    public function processAccountDeletion()
    {
        $customer = Auth::user();
        $customer->status = "deleted";
        if ($customer->save()) {
            $jobs = JobListing::where("customer_id", Auth::user()->id)->update([
                'status' => "deleted",
            ]);

            toast('Account Deleted Successfully.', 'success');
            return back();
        } else {
            toast('Something Went Wrong.', 'error');
            return back();
        }
    }
}
