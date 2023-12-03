<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Customer;
use App\Models\CustomerWallet;
use App\Models\JobListing;
use App\Models\NotificationSetting;
use App\Models\PlatformCategories;
use Auth;
use Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BusinessAccountController extends Controller
{

    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * dashboard
     *
     * @return void
     */
    public function dashboard()
    {
        $jobs = JobListing::orderBy("id", "desc")->select("id", "customer_id", "job_title", "job_description", "engagement_type", "city", "currency", "minimum_salary", "maximum_salary", "created_at")->where("customer_id", Auth::user()->id)->limit(5)->get();
        return new JsonResponse([
            'message' => 'Successful',
            'total_jobs' => JobListing::where("customer_id", Auth::user()->id)->count(),
            'applications' => 0,
            'referral_points' => (double) CustomerWallet::where("customer_id", Auth::user()->id)->first()->referral_points,
            'jobs' => $jobs->makeHidden(["featured_images", "featured_files"]),
            'applicants' => [],
        ], 200);
    }

    /**
     * viewProfile
     *
     * @return void
     */
    public function viewProfile()
    {
        return new JsonResponse([
            'message' => 'Successful',
            'profile' => Auth::user(),
        ], 200);
    }

    /**
     * updateUsername
     *
     * @param Request request
     *
     * @return void
     */
    public function updateUsername(Request $request)
    {
        $validator = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $customer = Customer::find(Auth::user()->id);

        if (!$customer->update($validator)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Username Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Successful',
                'profile' => $customer,
            ],
        ], 200);
    }

    /**
     * updateEmail
     *
     * @param Request request
     *
     * @return void
     */
    public function updateEmail(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required',
        ]);

        $customer = Customer::find(Auth::user()->id);

        $emailExist = Customer::where("email", $request->email)->where("id", "!=", $customer->id)->first();

        if (isset($emailExist)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Email Update Failed',
                    'details' => 'The Provided Email has already been used by another user',
                ],
            ], 400);
        }

        if (!$customer->update($validator)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Email Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Successful',
                'profile' => $customer,
            ],
        ], 200);
    }

    /**
     * updatePhoneNumber
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePhoneNumber(Request $request)
    {
        $validator = $this->validate($request, [
            'phone' => 'required',
        ]);

        $customer = Customer::find(Auth::user()->id);

        $phoneExist = Customer::where("phone", $request->phone)->where("id", "!=", $customer->id)->first();

        if (isset($phoneExist)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Phone Number Update Failed',
                    'details' => 'The Provided Phone number has already been used by another user',
                ],
            ], 400);
        }

        if (!$customer->update($validator)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Phone Number Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Successful',
                'profile' => $customer,
            ],
        ], 200);
    }

    /**
     * updateCountry
     *
     * @param Request request
     *
     * @return void
     */
    public function updateCountry(Request $request)
    {
        $validator = $this->validate($request, [
            'country' => 'required',
        ]);

        $customer = Customer::find(Auth::user()->id);

        if (!$customer->update($validator)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Country Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Successful',
                'profile' => $customer,
            ],
        ], 200);
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
        $validator = $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required',
        ]);

        $customer = Auth::user();

        if (!Hash::check($request->current_password, $customer->password)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Change Password',
                    'details' => 'Invalid Current Password',
                ],
            ], 400);
        }

        $customer->password = Hash::make($request->new_password);
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
     * updateProfilePhoto
     *
     * @param Request request
     *
     * @return void
     */
    public function updateProfilePhoto(Request $request)
    {
        $validator = $this->validate($request, [
            'profile_photo' => 'required',
        ]);

        $customer = Customer::find(Auth::user()->id);
        $customer->photo = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
        if (!$customer->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Profile Photo Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Successful',
                'profile_photo' => $customer->photo,
            ],
        ], 200);
    }

    /**
     * viewNotificationSettings
     *
     * @return void
     */
    public function viewNotificationSettings()
    {

        $notSet = NotificationSetting::where('customer_id', Auth::user()->id)->first();
        return new JsonResponse([
            'response' => [
                'message' => 'Successful',
                'notification_settings' => $notSet,
            ],
        ], 200);
    }

    /**
     * updateNotificationSettings
     *
     * @param Request request
     *
     * @return void
     */
    public function updateNotificationSettings(Request $request)
    {
        $validator = $this->validate($request, [
            'push_notification' => 'required',
            'email_notification' => 'required',
        ]);

        $notSet = NotificationSetting::where('customer_id', Auth::user()->id)->first();

        if (!$notSet->update($validator)) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Notification Settings Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Notification Settings Updated Successfully',
                'notification_settings' => $notSet,
            ],
        ], 200);
    }

    /**
     * viewBusinessDetails
     *
     * @return void
     */
    public function viewBusinessDetails()
    {
        $busDet = Business::where("customer_id", Auth::user()->id)->first();
        return new JsonResponse([
            'response' => [
                'message' => 'Successful',
                'business_details' => $busDet,
            ],
        ], 200);
    }

    /**
     * updateBusinessName
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessName(Request $request)
    {
        $validator = $this->validate($request, [
            'business_name' => 'required',
        ]);

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->business_name = $request->business_name;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Name Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Business Name Updated Successfully',
                'profile' => $business,
            ],
        ], 200);
    }

    /**
     * updateBusinessEmail
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessEmail(Request $request)
    {
        $validator = $this->validate($request, [
            'business_email' => 'required',
        ]);

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->business_email = $request->business_email;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Email Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Business Email Updated Successfully',
                'profile' => $business,
            ],
        ], 200);
    }

    /**
     * updateBusinessPhone
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessPhone(Request $request)
    {
        $validator = $this->validate($request, [
            'business_phone' => 'required',
        ]);

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->business_phone = $request->business_phone;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Phone Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Business Phone Updated Successfully',
                'profile' => $business,
            ],
        ], 200);
    }

    /**
     * updateBusinessCategory
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessCategory(Request $request)
    {
        $validator = $this->validate($request, [
            'business_category' => 'required',
        ]);

        $category = PlatformCategories::find($request->business_category);
        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->category_id = $category->id;
        $business->business_category = $category->category_name;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Category Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Business Category Updated Successfully',
                'profile' => $business,
            ],
        ], 200);
    }

    /**
     * updateBusinessDescription
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessDescription(Request $request)
    {
        $validator = $this->validate($request, [
            'business_description' => 'required',
        ]);

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->business_description = $request->business_description;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Description Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Business Description Updated Successfully',
                'profile' => $business,
            ],
        ], 200);
    }

    /**
     * updateBusinessAddress
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessAddress(Request $request)
    {
        $validator = $this->validate($request, [
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
        ]);

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->country = $request->country;
        $business->city = $request->city;
        $business->street = $request->street;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Address Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Business Address Updated Successfully',
                'profile' => $business,
            ],
        ], 200);
    }

    /**
     * updateBusinessSocials
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessSocials(Request $request)
    {

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->facebook_url = $request->facebook_url;
        $business->twitter_url = $request->twitter_url;
        $business->instagram_url = $request->instagram_url;
        $business->linkedin_url = $request->linkedin_url;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Socials Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Business Socials Updated Successfully',
                'profile' => $business,
            ],
        ], 200);
    }

    /**
     * updateBusinessWebsite
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessWebsite(Request $request)
    {

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->website_url = $request->website_url;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Website Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Business Website Updated Successfully',
                'profile' => $business,
            ],
        ], 200);
    }

    /**
     * updateBusinessLogo
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessLogo(Request $request)
    {
        $validator = $this->validate($request, [
            'business_logo' => 'required',
        ]);

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->business_logo = Cloudinary::upload($request->file('business_logo')->getRealPath())->getSecurePath();
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Business Logo Update Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'message' => 'Successful',
                'business_logo' => $business->business_logo,
            ],
        ], 200);
    }

    /**
     * deleteAccount
     *
     * @param Request request
     *
     * @return void
     */
    public function deleteAccount(Request $request)
    {
        $customer = Customer::find(Auth::user()->id);
        if ($customer->delete()) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Successful',
                    'profile' => 'Account Deleted Successfully',
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'response' => [
                    'message' => 'Account Deletion Failed',
                    'details' => 'Something Went Wrong',
                ],
            ], 400);
        }
    }
}
