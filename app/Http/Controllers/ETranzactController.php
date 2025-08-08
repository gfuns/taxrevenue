<?php
namespace App\Http\Controllers;

use App\Mail\AdminRenewalNotification as AdminRenewalNotification;
use App\Models\PaymentHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mail;

class ETranzactController extends Controller
{

    public function handleBillPaymentCallback(Request $request)
    {

        $response = Http::accept('application/json')->withHeaders([
            'authorization' => env('CREDO_SECRET_KEY'),
            'content_type'  => "Content-Type: application/json",
        ])->get(env("CREDO_URL") . "/transaction/{$request->reference}/verify");

        $payment = $response->collect("data");

        $status  = $payment["status"];
        $message = $payment["statusMessage"] == "Successfully processed" ? "successful" : "failed";

        $paymentData = PaymentHistory::where("reference_number", $request->reference)->first();

        if (isset($paymentData)) {

            try {

                $paymentData->status = $message;
                $paymentData->save();

                try {
                    $user = User::where("email", "tsegbatersootimothy@gmail.com")->first();
                    Mail::to($user)->send(new AdminRenewalNotification($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                }

            } catch (\Exception $e) {

                report($e);

                toast("We Could Not Settle This Transaction.", 'error');
                return redirect()->route("individual.paymentPreview", [$request->reference]);
            }
        } else {
            toast("Something Went Wrong.", 'error');
            return redirect()->route("individual.paymentPreview", [$request->reference]);
        }
    }

}
