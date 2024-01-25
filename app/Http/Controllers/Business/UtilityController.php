<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\AirtimeProviders;
use App\Models\UtilityTransactions;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UtilityController extends Controller
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

    public function utilityTransactions(Request $request)
    {
        $service = request()->service;
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->service) && !isset(request()->status)) {
            //Only Search has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && isset(request()->service) && !isset(request()->status)) {
            //Search and service has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("trx_type", $service)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", $service)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && !isset(request()->service) && isset(request()->status)) {
            //Search and status has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("status", $status)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("status", $status)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && isset(request()->service) && isset(request()->status)) {
            //Search, service and status has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("trx_type", $service)->where("status", $status)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", $service)->where("status", $status)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->service) && isset(request()->status)) {
            //Service and status has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("trx_type", $service)->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", $service)->where("status", $status)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->service) && !isset(request()->status)) {
            //Only Service has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("trx_type", $service)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", $service)->paginate(50);

        } else if (!isset(request()->search) && !isset(request()->service) && isset(request()->status)) {
            //Only Status has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("status", $status)->paginate(50);

        } else {
            $lastRecord = UtilityTransactions::where("customer_id", Auth::user()->id)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->paginate(50);
        }
        return view("business.utility_transactions", compact("transactions", "lastRecord", "marker", "search", "service", "status"));

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

    public function buyAirtime()
    {
        $airtimeProviders = AirtimeProviders::where("status", "Active")->get();
        return view("business.buy_airtime", compact("airtimeProviders"));
    }

    public function airtimePurchasePreview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'recharge_amount' => 'required|numeric',
            'biller' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = AirtimeProviders::where("biller", $request->biller)->first();
        $topupAmount = abs(preg_replace("/,/", "", $request->recharge_amount));

        $transaction = new UtilityTransactions;
        $transaction->customer_id = Auth::user()->id;
        $transaction->transaction_id = $this->genTrxId();
        $transaction->reference = $this->generateVTPassReference();
        $transaction->trx_type = "Airtime";
        $transaction->biller = $provider->biller;
        $transaction->recipient = $request->phone_number;
        $transaction->amount = $topupAmount;
        $transaction->fee = $provider->fee;
        $transaction->total_amount = (double) ($topupAmount + $provider->fee);
        if ($transaction->save()) {
            return redirect()->route("business.airtimePreview", [$transaction->transaction_id]);
        } else {
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function airtimePreview($trxId)
    {
        $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
        return view("business.airtime_preview", compact("trx"));
    }

    public function airtimeWalletPayment($trxId)
    {
        $trx = BillTransactions::where("transaction_id", $trxId)->first();
        $trx->payment_method = "Account Balance";
        $trx->save();

        $user = Auth::user();
        $user->account_balance = (double) ($user->account_balance - $trx->total_amount);
        $user->save();

        try {
            $vtPass = ThirdpartyApi::find(4);

            $data = array(
                'serviceID' => $trx->biller == "9Mobile" ? 'etisalat' : strtolower($trx->biller),
                'amount' => (int) $trx->amount,
                'phone' => $trx->recipient,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, $vtPass->public_key . ":" . $vtPass->secret_key);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = BillTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Successful";
                $trx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new AirtimeSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    return redirect("/account/dashboard")->with(["success" => "Transaction Successful"]);
                }

            } else if ($result->code == "000" && $result->response_description == "TRANSACTION PROCESSING - PENDING") {
                $trx = BillTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                return redirect("/account/dashboard")->with(["info" => "You will be notified via email as soon as the transaction status is updated"]);
            } else {
                $trx = BillTransactions::where("transaction_id", $trxId)->first();

                $user = Auth::user();
                $user->account_balance = (double) ($user->account_balance + $trx->total_amount);
                $user->save();

                $trx->status = "Failed";
                $trx->save();

                return redirect("/account/dashboard")->with(["error" => "Transaction Failed"]);
            }
        } catch (\Exception $e) {
            report($e);
            return back()->with(["error" => "Something Went Wrong"]);
        }
    }

    public function genTrxId()
    {
        $pin = range(0, 12);
        $set = shuffle($pin);
        $code = "";
        for ($i = 0; $i < 12; $i++) {
            $code = $code . "" . $pin[$i];
        }

        return "T" . $code;
    }

    public function generateVTPassReference()
    {
        $date = date('Ymd');
        $seconds = date('i');
        $hour = date('H') + 1;
        if ($hour < 10) {
            $hour = "0" . $hour;
        }

        $reference = $date . "" . $hour . "" . $seconds . strtoupper(Str::random(6));
        return $reference;
    }

}
