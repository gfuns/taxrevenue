<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Artisans;
use App\Models\Customer;
use App\Models\NotificationSetting;
use Auth;
use Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ArtisanAccountController extends Controller
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
            'biography' => 'required',
            'profession' => 'required',
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

        try {

            DB::beginTransaction();
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->country = $request->country;
            $customer->save();

            $artisan = Artisans::where("customer_id", $customer->id)->first();
            $artisan->biography = $request->biography;
            $artisan->profession = $request->profession;
            $artisan->save();

            DB::commit();

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
        } catch (\Exception $e) {
            DB::rollback();
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }

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
