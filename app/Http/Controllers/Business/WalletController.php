<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Mail\BonusWithdrawalSuccessful as BonusWithdrawalSuccessful;
use App\Mail\TopupSuccessful as TopupSuccessful;
use App\Mail\WithdrawalSuccessful as WithdrawalSuccessful;
use App\Models\AreteWalletTransaction;
use App\Models\BankList;
use App\Models\PaystackTransaction;
use App\Models\ReferralTransaction;
use Auth;
use Coderatio\PaystackMirror\Actions\Transactions\VerifyTransaction;
use Coderatio\PaystackMirror\PaystackMirror;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use Ramsey\Uuid\Uuid;

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
        $marker     = $this->getMarkers($lastRecord, request()->page);
        $topUps     = AreteWalletTransaction::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", "credit")->paginate(50);
        $bankList   = BankList::all();
        return view("business.wallet", compact("topUps", "lastRecord", "marker", "bankList"));
    }

    public function withdrawals()
    {
        $lastRecord  = AreteWalletTransaction::where("customer_id", Auth::user()->id)->where("trx_type", "debit")->count();
        $marker      = $this->getMarkers($lastRecord, request()->page);
        $withdrawals = AreteWalletTransaction::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", "debit")->paginate(50);
        $bankList    = BankList::all();
        return view("business.wallet_withdrawals", compact("withdrawals", "lastRecord", "marker", "bankList"));
    }

    public function pointsTransaction()
    {
        $lastRecord   = ReferralTransaction::where("customer_id", Auth::user()->id)->count();
        $marker       = $this->getMarkers($lastRecord, request()->page);
        $transactions = ReferralTransaction::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->paginate(50);
        $bankList     = BankList::all();
        return view("business.wallet_points", compact("transactions", "lastRecord", "marker", "bankList"));
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

        try {
            $transaction              = new PaystackTransaction;
            $transaction->customer_id = Auth::user()->id;
            $transaction->trx_type    = "topup";
            $transaction->reference   = "pm_rf" . Str::random(11);
            $transaction->amount      = $request->topup_amount;
            if ($transaction->save()) {
                $response = Http::accept('application/json')->withHeaders([
                    'authorization' => "Bearer " . env('ALT_PAYSTACK_SECRET_KEY'),
                    'content_type'  => "Content-Type: application/json",
                ])->post("https://api.paystack.co/transaction/initialize", [
                    "email"     => Auth::user()->email,
                    "amount"    => ($transaction->amount * 100),
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
        } catch (\Exception $e) {
            report($e);
            toast('We encountered an error while trying to connect with our payment provider. Please Try again after some time', 'error');
            return back();
        }
    }

    public function initiateWalletWithdrawal(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'bank'           => 'required',
            'account_number' => 'required',
            'account_name'   => 'required',
            'amount'         => 'required',
        ]);

        if (Auth::user()->withdrawal_confirmation == 'GoogleAuth') {
            $validator = Validator::make($request->all(), [
                'google_authenticator_code' => 'required',
            ]);
        }

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $withdrawalAmount = abs(preg_replace("/,/", "", $request->amount));

        if (Auth::user()->withdrawal_confirmation == 'GoogleAuth') {
            $google2fa = app('pragmarx.google2fa');
            $valid     = $google2fa->verify($request->google_authenticator_code, Auth::user()->google2fa_secret);

            if (! $valid) {
                toast('Invalid Google Authenticator Code Provided.', 'error');
                return back();
            }
        }

        if ($withdrawalAmount > Auth::user()->wallet->arete_balance) {
            toast('Insufficiant Wallet Balance.', 'error');
            return back();
        } else {

            try {
                $response = Http::accept('application/json')->withHeaders([
                    'Authorization' => "Bearer " . env('ALT_PAYSTACK_SECRET_KEY'),
                ])->post("https://api.paystack.co/transferrecipient", [
                    "type"           => "nuban",
                    "name"           => $request->account_name,
                    "account_number" => $request->account_number,
                    "bank_code"      => $request->bank,
                    "currency"       => "NGN",
                ]);

                $result = $response->json();

                if ($result["status"] === true) {

                    $data = $response->collect("data");

                    $recipient = $data["recipient_code"];
                    $reference = Uuid::uuid4();

                    //Initiate the Actual Transfer

                    $response = Http::accept('application/json')->withHeaders([
                        'Authorization' => "Bearer " . env('ALT_PAYSTACK_SECRET_KEY'),
                    ])->post("https://api.paystack.co/transfer", [
                        "source"    => "balance",
                        "reason"    => "Customer Funds Withdrawal from Arete Nigeria",
                        "amount"    => (abs($request->amount) * 100),
                        "recipient" => $recipient,
                        "reference" => $reference,
                    ]);

                    $transferRes = $response->json();

                    if ($transferRes["status"] === true) {
                        $transferData = $response->collect("data");

                        $bankName = BankList::where("bank_code", $request->bank)->first()->bank_name;

                        DB::beginTransaction();

                        $trx                 = new AreteWalletTransaction;
                        $trx->customer_id    = Auth::user()->id;
                        $trx->trx_type       = "debit";
                        $trx->payment_method = "Direct Transfer";
                        $trx->amount         = $withdrawalAmount;
                        $trx->description    = "Customer Wallet Withdrawal";
                        $trx->reference      = $transferData["reference"];
                        $trx->bank           = $bankName;
                        $trx->account_number = $request->account_number;
                        $trx->account_name   = $request->account_name;
                        $trx->balance_before = Auth::user()->wallet->arete_balance;
                        $trx->balance_after  = (Auth::user()->wallet->arete_balance - $withdrawalAmount);
                        $trx->status         = "Successful";
                        $trx->save();

                        $wallet                = Auth::user()->wallet;
                        $wallet->arete_balance = (Auth::user()->wallet->arete_balance - $withdrawalAmount);
                        $wallet->save();

                        DB::commit();

                        try {
                            $user = Auth::user();
                            Mail::to($user)->send(new WithdrawalSuccessful($user, $trx));
                        } catch (\Exception $e) {
                            report($e);
                        }

                        toast("Funds Withdrawal Successful", 'success');
                        return redirect()->route("business.myWallet");
                    } else {
                        toast($transferRes["message"], 'error');
                        return redirect()->route("business.myWallet");
                    }
                } else {
                    toast($result["message"], 'error');
                    return redirect()->route("business.myWallet");
                }
            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("Something Went Wrong", 'error');
                return redirect()->route("business.myWallet");
            }
        }

    }

    public function initiateBonusWithdrawal(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'bank'           => 'required',
            'account_number' => 'required',
            'account_name'   => 'required',
            'amount'         => 'required',
        ]);

        if (Auth::user()->withdrawal_confirmation == 'GoogleAuth') {
            $validator = Validator::make($request->all(), [
                'google_authenticator_code' => 'required',
            ]);
        }

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $withdrawalAmount = abs(preg_replace("/,/", "", $request->amount));

        if (Auth::user()->withdrawal_confirmation == 'GoogleAuth') {
            $google2fa = app('pragmarx.google2fa');
            $valid     = $google2fa->verify($request->google_authenticator_code, Auth::user()->google2fa_secret);

            if (! $valid) {
                toast('Invalid Google Authenticator Code Provided.', 'error');
                return back();
            }
        }

        if (Auth::user()->wallet->referral_points < 10000) {
            toast('You can only withdraw when you have accummulated a bonus of 10,000 Naira.', 'error');
            return back();
        } else if ($withdrawalAmount > Auth::user()->wallet->referral_points) {
            toast('Insufficient Bonus Balance.', 'error');
            return back();
        } else {
            try {
                $response = Http::accept('application/json')->withHeaders([
                    'Authorization' => "Bearer " . env('ALT_PAYSTACK_SECRET_KEY'),
                ])->post("https://api.paystack.co/transferrecipient", [
                    "type"           => "nuban",
                    "name"           => $request->account_name,
                    "account_number" => $request->account_number,
                    "bank_code"      => $request->bank,
                    "currency"       => "NGN",
                ]);

                $result = $response->json();

                if ($result["status"] === true) {

                    $data = $response->collect("data");

                    $recipient = $data["recipient_code"];
                    $reference = Uuid::uuid4();

                    //Initiate the Actual Transfer

                    $response = Http::accept('application/json')->withHeaders([
                        'Authorization' => "Bearer " . env('ALT_PAYSTACK_SECRET_KEY'),
                    ])->post("https://api.paystack.co/transfer", [
                        "source"    => "balance",
                        "reason"    => "Customer Funds Withdrawal from Arete Nigeria",
                        "amount"    => (abs($request->amount) * 100),
                        "recipient" => $recipient,
                        "reference" => $reference,
                    ]);

                    $transferRes = $response->json();

                    if ($transferRes["status"] === true) {
                        $transferData = $response->collect("data");

                        $bankName = BankList::where("bank_code", $request->bank)->first()->bank_name;

                        DB::beginTransaction();

                        $trx                 = new ReferralTransaction;
                        $trx->customer_id    = Auth::user()->id;
                        $trx->trx_type       = "debit";
                        $trx->amount         = $withdrawalAmount;
                        $trx->details        = "Customer Bonus Withdrawal";
                        $trx->reference      = $transferData["reference"];
                        $trx->bank           = $bankName;
                        $trx->account_number = $request->account_number;
                        $trx->account_name   = $request->account_name;
                        $trx->balance_before = Auth::user()->wallet->referral_points;
                        $trx->balance_after  = (Auth::user()->wallet->referral_points - $withdrawalAmount);
                        $trx->status         = "Successful";
                        $trx->save();

                        $wallet                  = Auth::user()->wallet;
                        $wallet->referral_points = (Auth::user()->wallet->referral_points - $withdrawalAmount);
                        $wallet->save();

                        DB::commit();

                        try {
                            $user = Auth::user();
                            Mail::to($user)->send(new BonusWithdrawalSuccessful($user, $trx));
                        } catch (\Exception $e) {
                            report($e);
                        }

                        toast("Bonus Withdrawal Successful", 'success');
                        return redirect()->route("business.myWallet");
                    } else {
                        toast($transferRes["message"], 'error');
                        return redirect()->route("business.myWallet");
                    }
                } else {
                    toast($result["message"], 'error');
                    return redirect()->route("business.myWallet");
                }
            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("Something Went Wrong", 'error');
                return redirect()->route("business.myWallet");
            }
        }

    }

    public function validateBankAccount(Request $request)
    {
        $response = Http::accept('application/json')->withHeaders([
            'Authorization' => "Bearer " . env('ALT_PAYSTACK_SECRET_KEY'),
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

    public function handlePaystackCallback(Request $request)
    {
        $payment = PaystackMirror::run(env('ALT_PAYSTACK_SECRET_KEY'), new VerifyTransaction($request->reference))
            ->getResponse()->asObject();

        if (! isset($payment->data)) {
            toast("Something Went Wrong", 'error');
            return redirect()->route("business.myWallet");
        }

        $paystack    = PaystackTransaction::where("reference", $payment->data->reference)->where('processed', 0)->first();
        $cardDetails = $payment->data->authorization;
        if (isset($paystack) && isset($cardDetails)) {

            try {
                DB::beginTransaction();

                $paystack->processed = 1;
                $paystack->status    = $payment->data->status == "success" ? "Successful" : "Failed";
                $paystack->save();

                if ($paystack->trx_type == "topup") {
                    $trx                 = new AreteWalletTransaction;
                    $trx->customer_id    = Auth::user()->id;
                    $trx->trx_type       = "credit";
                    $trx->payment_method = ucwords($cardDetails->brand) . " ending with " . $cardDetails->last4;
                    $trx->amount         = $paystack->amount;
                    $trx->description    = "Customer Wallet Balance Topup";
                    $trx->reference      = $paystack->reference;
                    $trx->balance_before = Auth::user()->wallet->arete_balance;
                    $trx->balance_after  = (Auth::user()->wallet->arete_balance + $paystack->amount);
                    $trx->status         = $payment->data->status == "success" ? "Successful" : "Failed";
                    $trx->save();

                    $wallet                = Auth::user()->wallet;
                    $wallet->arete_balance = (Auth::user()->wallet->arete_balance + $paystack->amount);
                    $wallet->save();

                    DB::commit();

                    try {
                        $user = Auth::user();
                        Mail::to($user)->send(new TopupSuccessful($user, $trx));
                    } catch (\Exception $e) {
                        report($e);
                    }

                    toast("Wallet Topup Successful", 'success');
                    return redirect()->route("business.myWallet");
                }

            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("Something Went Wrong", 'error');
                return redirect()->route("business.myWallet");
            }

        } else {
            toast("This transaction has already been processed", 'error');
            return redirect()->route("business.myWallet");
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
        $end    = (50 * ((int) $pageNum));
        $marker = [];
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
