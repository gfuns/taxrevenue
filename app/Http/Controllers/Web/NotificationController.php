<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * viewNotifications
     *
     * @return void
     */
    public function viewNotifications()
    {
        $notifications = Notification::orderBy("id", 'desc')->where("customer_id", Auth::user()->id)->limit(10)->get();

        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'notifications' => $notifications,
            ],
        ], 200);
    }

    /**
     * deleteNotification
     *
     * @param Request request
     *
     * @return void
     */
    public function deleteNotification(Request $request)
    {

        $validator = $this->validate($request, [
            'notification_id' => 'required',
        ]);

        $notification = Notification::find($request->notification_id);
        if (isset($notification)) {
            if ($notification->delete()) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        'data' => [
                            'message' => 'Notification Deleted Successfully',
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
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Notification with the provided id does not exist',
                ],
            ], 400);
        }

    }

    /**
     * clearNotifications
     *
     * @return void
     */
    public function clearNotifications()
    {
        $notifications = Notification::where("customer_id", Auth::user()->id)->delete();
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'message' => 'All Notifications Deleted Successfully',
                ],
            ],
        ], 200);
    }
}
