<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Customer;
use App\Models\NotificationSetting;
use App\Models\PlatformCategories;
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
        return view("business.dashboard");
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
}
