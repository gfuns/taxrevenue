<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\AreteWalletTransaction;
use App\Models\BankList;
use App\Models\PaystackTransaction;
use App\Models\ReferralTransaction;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WalletController extends Controller
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

    public function myWallet()
    {
        $lastRecord = AreteWalletTransaction::where("customer_id", Auth::user()->id)->where("trx_type", "credit")->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $topUps = AreteWalletTransaction::where("customer_id", Auth::user()->id)->where("trx_type", "credit")->paginate(50);
        $bankList = BankList::all();
        return view("business.wallet", compact("topUps", "lastRecord", "marker", "bankList"));
    }

    public function withdrawals()
    {
        $lastRecord = AreteWalletTransaction::where("customer_id", Auth::user()->id)->where("trx_type", "debit")->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $withdrawals = AreteWalletTransaction::where("customer_id", Auth::user()->id)->where("trx_type", "debit")->paginate(50);
        return view("business.wallet_withdrawals", compact("withdrawals", "lastRecord", "marker"));
    }

    public function pointsTransaction()
    {
        $lastRecord = ReferralTransaction::where("customer_id", Auth::user()->id)->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $transactions = ReferralTransaction::where("customer_id", Auth::user()->id)->paginate(50);
        return view("business.wallet_points", compact("transactions", "lastRecord", "marker"));
    }

    public function initiateWalletTopup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topup_amount' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $transaction = new PaystackTransaction;
        $transaction->customer_id = Auth::user()->id;
        $transaction->trx_type = "topup";
        $transaction->reference = "pm_rf" . Str::random(11);
        $transaction->amount = $request->topup_amount;
        if ($transaction->save()) {
            $response = Http::accept('application/json')->withHeaders([
                'authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                'content_type' => "Content-Type: application/json",
            ])->post("https://api.paystack.co/transaction/initialize", [
                "email" => Auth::user()->email,
                "amount" => ($transaction->amount * 100),
                "reference" => $transaction->reference,
            ]);

            $responseData = $response->collect("data");

            if (isset($responseData['authorization_url'])) {
                return redirect($responseData['authorization_url']);
            }

            toast("Paystack gateway service took too long to respond", 'error');
            return back();

        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    public function initiateWalletWithdrawal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
            'withdrawal_amount' => 'required',
            'ga_code' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

    }

    public function validateBankAccount(Request $request)
    {
        $response = Http::accept('application/json')->withHeaders([
            'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
        ])->get("https://api.paystack.co/bank/resolve", ["account_number" => $request->accountnumber, "bank_code" => $request->bank]);

        $accountInfo = $response->json();

        if ($accountInfo["status"] === true) {
            $bankInfo = $response->collect("data");
            if (isset($bankInfo["account_name"])) {
                return response()->json(['account_name' => $bankInfo["account_name"]], 200);
            } else {
                return response()->json(['message' => "Account Number Validation Failed"], 400);
            }

        } else {
            return response()->json(['message' => "Account Number Validation Failed"], 400);
        }
    }

    /**
     * getMarkers Helper Function
     *
     * @param mixed lastRecord
     * @param mixed pageNum
     *
     * @return void
     */
    public function getMarkers($lastRecord, $pageNum)
    {
        if ($pageNum == null) {
            $pageNum = 1;
        }
        $end = (50 * ((int) $pageNum));
        $marker = array();
        if ((int) $pageNum == 1) {
            $marker["begin"] = (int) $pageNum;
            $marker["index"] = (int) $pageNum;
        } else {
            $marker["begin"] = number_format(((50 * ((int) $pageNum)) - 49), 0);
            $marker["index"] = number_format(((50 * ((int) $pageNum)) - 49), 0);
        }

        if ($end > $lastRecord) {
            $marker["end"] = number_format($lastRecord, 0);
        } else {
            $marker["end"] = number_format($end, 0);
        }

        return $marker;
    }
}
