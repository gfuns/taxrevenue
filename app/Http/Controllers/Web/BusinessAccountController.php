<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Customer;
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
     * viewProfile
     *
     * @return void
     */
    public function viewProfile()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'message' => 'Successful',
                'profile' => Auth::user(),
            ],
        ], 200);
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
        $validator = $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
        ]);

        $customer = Customer::find(Auth::user()->id);

        $emailExist = Customer::where("email", $request->email)->where("id", "!=", $customer->id)->first();

        if (isset($emailExist)) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'The Provided Email has already been used by another user',
                ],
            ], 400);
        }

        $phoneExist = Customer::where("phone", $request->phone)->where("id", "!=", $customer->id)->first();

        if (isset($phoneExist)) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'The Provided Phone number has already been used by another user',
                ],
            ], 400);
        }

        if (!$customer->update($validator)) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'message' => 'Successful',
                    'profile' => $customer,
                ],
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
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Invalid Current Password',
                ],
            ], 400);
        }

        $customer->password = Hash::make($request->new_password);
        if (!$customer->save()) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'message' => 'Password Changed Successfully',
                ],
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
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'profile_photo' => $customer->photo,
                ],
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
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'notification_settings' => $notSet,
                ],
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
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'notification_settings' => $notSet,
                ],
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
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'business_details' => $busDet,
                ],
            ],
        ], 200);
    }

    /**
     * updateBusinessDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessDetails(Request $request)
    {
        $validator = $this->validate($request, [
            'business_name' => 'required',
            'business_category' => 'required|integer',
            'business_address' => 'required',
            'business_email' => 'required',
            'business_phone' => 'required',
            'business_description' => 'required',
        ]);

        $category = PlatformCategories::find($request->business_category);

        if (!isset($category)) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'We could not find the selected category on our records',
                ],
            ], 400);
        }

        $business = Business::where("customer_id", Auth::user()->id)->first();
        $business->business_name = $request->business_name;
        $business->category_id = $category->id;
        $business->business_category = $category->category_name;
        $business->business_address = $request->business_address;
        $business->business_email = $request->business_email;
        $business->business_phone = $request->business_phone;
        $business->business_description = $request->business_description;
        $business->website_url = $request->website_url;
        $business->facebook_url = $request->facebook_url;
        $business->twitter_url = $request->twitter_url;
        $business->instagram_url = $request->instagram_url;
        $business->linkedin_url = $request->linkedin_url;
        if (!$business->save()) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'profile' => $business,
                ],
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
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'business_logo' => $business->business_logo,
                ],
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
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    'data' => [
                        'profile' => 'Account Deleted Successfully',
                    ],
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }
    }
}
