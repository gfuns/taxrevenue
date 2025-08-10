<?php
namespace App\Http\Controllers;

use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $paymentData = PaymentHistory::where("reference", $request->reference)->first();

        if (isset($paymentData)) {

            try {

                $paymentData->status = $message;
                $paymentData->save();

                // try {
                //     $user = Auth::user();
                //     Mail::to($user)->send(new PaymentNotification($user, $paymentData));
                // } catch (\Exception $e) {
                //     report($e);
                // }

                toast("Payment Successful.", 'success');
                return redirect()->route("individual.billPayments");

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
