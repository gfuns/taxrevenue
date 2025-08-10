<?php
namespace App\Http\Controllers;

use App\Models\PaymentHistory;

class ReceiptController extends Controller
{

    /**
     * companyRenewalReceipt
     *
     * @param mixed reference
     *
     * @return void
     */
    public function paymentReceipt($reference)
    {
        $google2fa       = app('pragmarx.google2fa');
        $google2faSecret = $google2fa->generateSecretKey();
        $QRImage         = $google2fa->getQRCodeInline(
            env('APP_NAME'),
            route("receipt.paymentReceipt", [$reference]),
            $google2faSecret,
            150
        );
        $trx = PaymentHistory::where("reference", $reference)->first();
        return view("individual.receipts.payment_receipt", compact("trx", "QRImage"));
    }

}
