<?php
namespace App\Http\Controllers;

use App\Models\AwardLetter;
use App\Models\CompanyRenewals;
use App\Models\PowerOfAttorney;
use App\Models\ProcessingFee;

class ReceiptController extends Controller
{

    /**
     * companyRenewalReceipt
     *
     * @param mixed reference
     *
     * @return void
     */
    public function companyRenewalReceipt($reference)
    {
        $google2fa       = app('pragmarx.google2fa');
        $google2faSecret = $google2fa->generateSecretKey();
        $QRImage         = $google2fa->getQRCodeInline(
            env('APP_NAME'),
            route("receipt.companyRenewal", [$reference]),
            $google2faSecret,
            150
        );
        $trx = CompanyRenewals::where("reference_number", $reference)->first();
        return view("business.receipts.company_renewal", compact("trx", "QRImage"));
    }

    /**
     * powerOfAttorneyReceipt
     *
     * @param mixed reference
     *
     * @return void
     */
    public function powerOfAttorneyReceipt($reference)
    {
        $google2fa       = app('pragmarx.google2fa');
        $google2faSecret = $google2fa->generateSecretKey();
        $QRImage         = $google2fa->getQRCodeInline(
            env('APP_NAME'),
            route("receipt.powerOfAttorney", [$reference]),
            $google2faSecret,
            150
        );
        $trx = PowerOfAttorney::where("reference_number", $reference)->first();
        return view("business.receipts.poa", compact("trx", "QRImage"));
    }

    /**
     * awardLettersReceipt
     *
     * @param mixed reference
     *
     * @return void
     */
    public function awardLettersReceipt($reference)
    {
        $google2fa       = app('pragmarx.google2fa');
        $google2faSecret = $google2fa->generateSecretKey();
        $QRImage         = $google2fa->getQRCodeInline(
            env('APP_NAME'),
            route("receipt.awardLetters", [$reference]),
            $google2faSecret,
            150
        );
        $trx = AwardLetter::where("reference_number", $reference)->first();
        return view("business.receipts.award_letters", compact("trx", "QRImage"));
    }

    /**
     * processingFeesReceipt
     *
     * @param mixed reference
     *
     * @return void
     */
    public function processingFeesReceipt($reference)
    {
        $google2fa       = app('pragmarx.google2fa');
        $google2faSecret = $google2fa->generateSecretKey();
        $QRImage         = $google2fa->getQRCodeInline(
            env('APP_NAME'),
            route("receipt.processingFees", [$reference]),
            $google2faSecret,
            150
        );
        $trx = ProcessingFee::where("reference_number", $reference)->first();
        return view("business.receipts.processing_fee", compact("trx", "QRImage"));
    }
}
