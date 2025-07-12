<?php
namespace App\Http\Controllers;

use App\Models\AwardLetter;
use App\Models\Company;
use App\Models\CompanyPayments;
use App\Models\CompanyRenewals;
use App\Models\PowerOfAttorney;
use App\Models\ProcessingFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ETranzactController extends Controller
{

    public function handleRenewalCallback(Request $request)
    {
        $reference = "BSPPC-" . $request->reference;

        $response = Http::accept('application/json')->withHeaders([
            'authorization' => env('CREDO_SECRET_KEY'),
            'content_type'  => "Content-Type: application/json",
        ])->get(env("CREDO_URL") . "/transaction/{$request->reference}/verify");

        $payment = $response->collect("data");

        $status  = $payment["status"];
        $message = $payment["statusMessage"] == "Successfully processed" ? "awaiting approval" : "payment failed";

        $paymentData = CompanyPayments::where("reference_number", $reference)->first();

        if (isset($paymentData)) {

            try {
                DB::beginTransaction();

                $paymentData->status = $message;
                $paymentData->save();

                $trx         = CompanyRenewals::where("reference_number", $reference)->first();
                $trx->status = $message;
                $trx->save();

                DB::commit();

                toast("Payment Received Successfully", 'success');
                return redirect()->route("business.companyRenewals", [$reference]);

            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("We Could Not Settle This Transaction.", 'error');
                return redirect()->route("business.companyRenewalPreview", [$reference]);
            }
        } else {
            toast("Something Went Wrong.", 'error');
            return redirect()->route("business.companyRenewalPreview", [$reference]);
        }
    }

    public function handlePOACallback(Request $request)
    {
        $reference = "BSPPC-" . $request->reference;

        $response = Http::accept('application/json')->withHeaders([
            'authorization' => env('CREDO_SECRET_KEY'),
            'content_type'  => "Content-Type: application/json",
        ])->get(env("CREDO_URL") . "/transaction/{$request->reference}/verify");

        $payment = $response->collect("data");

        $status  = $payment["status"];
        $message = $payment["statusMessage"] == "Successfully processed" ? "awaiting approval" : "payment failed";

        $paymentData = CompanyPayments::where("reference_number", $reference)->first();

        if (isset($paymentData)) {

            try {
                DB::beginTransaction();

                $paymentData->status = $message;
                $paymentData->save();

                $trx         = PowerOfAttorney::where("reference_number", $reference)->first();
                $trx->status = $message;
                $trx->save();

                DB::commit();

                toast("Payment Received Successfully", 'success');
                return redirect()->route("business.powerOfAttorney", [$reference]);

            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("We Could Not Settle This Transaction.", 'error');
                return redirect()->route("business.powerOfAttorneyPreview", [$reference]);
            }
        } else {
            toast("Something Went Wrong.", 'error');
            return redirect()->route("business.powerOfAttorneyPreview", [$reference]);
        }
    }

    public function handlePRFCallback(Request $request)
    {
        $reference = "BSPPC-" . $request->reference;

        $response = Http::accept('application/json')->withHeaders([
            'authorization' => env('CREDO_SECRET_KEY'),
            'content_type'  => "Content-Type: application/json",
        ])->get(env("CREDO_URL") . "/transaction/{$request->reference}/verify");

        $payment = $response->collect("data");

        $status  = $payment["status"];
        $message = $payment["statusMessage"] == "Successfully processed" ? "awaiting approval" : "payment failed";

        $paymentData = CompanyPayments::where("reference_number", $reference)->first();

        if (isset($paymentData)) {

            try {
                DB::beginTransaction();

                $paymentData->status = $message;
                $paymentData->save();

                $trx         = ProcessingFee::where("reference_number", $reference)->first();
                $trx->status = $message;
                $trx->save();

                DB::commit();

                toast("Payment Received Successfully", 'success');
                return redirect()->route("business.processingFees", [$reference]);

            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("We Could Not Settle This Transaction.", 'error');
                return redirect()->route("business.processingFeesPreview", [$reference]);
            }
        } else {
            toast("Something Went Wrong.", 'error');
            return redirect()->route("business.processingFeesPreview", [$reference]);
        }
    }

    public function handleAwardCallback(Request $request)
    {
        $reference = "BSPPC-" . $request->reference;

        $response = Http::accept('application/json')->withHeaders([
            'authorization' => env('CREDO_SECRET_KEY'),
            'content_type'  => "Content-Type: application/json",
        ])->get(env("CREDO_URL") . "/transaction/{$request->reference}/verify");

        $payment = $response->collect("data");

        $status  = $payment["status"];
        $message = $payment["statusMessage"] == "Successfully processed" ? "awaiting approval" : "payment failed";

        $paymentData = CompanyPayments::where("reference_number", $reference)->first();

        if (isset($paymentData)) {

            try {
                DB::beginTransaction();

                $paymentData->status = $message;
                $paymentData->save();

                $trx         = AwardLetter::where("reference_number", $reference)->first();
                $trx->status = $message;
                $trx->save();

                DB::commit();

                toast("Payment Received Successfully", 'success');
                return redirect()->route("business.awardLetters", [$reference]);

            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("We Could Not Settle This Transaction.", 'error');
                return redirect()->route("business.awardLettersPreview", [$reference]);
            }
        } else {
            toast("Something Went Wrong.", 'error');
            return redirect()->route("business.awardLettersPreview", [$reference]);
        }
    }

    public function handleRegFormCallback(Request $request)
    {
        $reference = "BSPPC-" . $request->reference;

        $response = Http::accept('application/json')->withHeaders([
            'authorization' => env('CREDO_SECRET_KEY'),
            'content_type'  => "Content-Type: application/json",
        ])->get(env("CREDO_URL") . "/transaction/{$request->reference}/verify");

        $payment = $response->collect("data");

        $status  = $payment["status"];
        $message = $payment["statusMessage"] == "Successfully processed" ? "awaiting approval" : "payment failed";

        $paymentData = CompanyPayments::where("reference_number", $reference)->first();

        if (isset($paymentData)) {

            try {

                $paymentData->status = $message;
                $paymentData->save();

                toast("Payment Received Successfully", 'success');
                return redirect()->route("business.companyRegistration");

            } catch (\Exception $e) {
                report($e);

                toast("We Could Not Settle This Transaction.", 'error');
                return redirect()->route("business.companyRegistration");
            }
        } else {
            toast("Something Went Wrong.", 'error');
            return redirect()->route("business.companyRegistration");
        }
    }

    public function handleRegFeeCallback(Request $request)
    {
        $reference = "BSPPC-" . $request->reference;

        $response = Http::accept('application/json')->withHeaders([
            'authorization' => env('CREDO_SECRET_KEY'),
            'content_type'  => "Content-Type: application/json",
        ])->get(env("CREDO_URL") . "/transaction/{$request->reference}/verify");

        $payment = $response->collect("data");

        $status  = $payment["status"];
        $message = $payment["statusMessage"] == "Successfully processed" ? "awaiting approval" : "payment failed";

        $paymentData = CompanyPayments::where("reference_number", $reference)->first();

        if (isset($paymentData)) {

            try {
                DB::beginTransaction();

                $paymentData->status = $message;
                $paymentData->save();

                $company                       = Company::find($paymentData->company_id);
                $company->reg_reference_number = $reference;
                $company->status               = $message;
                $company->save();

                DB::commit();

                toast("Payment Received Successfully", 'success');
                return redirect()->route("business.companyRegistration");

            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("We Could Not Settle This Transaction.", 'error');
                return redirect()->route("business.companyRegistration");
            }
        } else {
            toast("Something Went Wrong.", 'error');
            return redirect()->route("business.companyRegistration");
        }
    }
}
