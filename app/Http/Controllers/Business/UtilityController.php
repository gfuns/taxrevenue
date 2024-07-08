<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Mail\AirtimeSuccessful as AirtimeSuccessful;
use App\Mail\CableSuccessful as CableSuccessful;
use App\Mail\DataSuccessful as DataSuccessful;
use App\Mail\ElectricitySuccessful as ElectricitySuccessful;
use App\Models\AirtimeProviders;
use App\Models\CableProvider;
use App\Models\CustomerWallet;
use App\Models\DataProvider;
use App\Models\ElectricityProviders;
use App\Models\ReferralTransaction;
use App\Models\UtilityTransactions;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use Session;

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

    public function pointsAirtimePurchase($trxId)
    {
        $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
        $trx->payment_method = "Bonus Balance";
        $trx->save();

        $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

        if ($customerWallet->referral_points < $trx->total_amount) {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->status = "Failed";
            $trx->save();

            toast("Your bonus balance is insufficient", 'error');
            return back();
        }

        $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
        $wallet->referral_points = (double) ($wallet->referral_points - $trx->total_amount);
        $wallet->save();

        try {
            $data = array(
                'serviceID' => $trx->biller == "9Mobile" ? 'etisalat' : strtolower($trx->biller),
                'amount' => (int) $trx->amount,
                'phone' => $trx->recipient,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Successful";
                $trx->save();

                $referralTrx = new ReferralTransaction;
                $referralTrx->customer_id = Auth::user()->id;
                $referralTrx->trx_type = "debit";
                $referralTrx->amount = $trx->total_amount;
                $referralTrx->details = "Airtime Purchase From " . $trx->biller;
                $referralTrx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new AirtimeSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    toast("Airtime Purchase Successful", 'success');
                    return redirect()->route("business.buyAirtime");
                }

            } else if ($result->code == "000" && $result->response_description == "TRANSACTION PROCESSING - PENDING") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                toast("Transaction is currently being processed", 'info');
                return redirect()->route("business.buyAirtime");
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                toast("Airtime Purchase Failed", 'error');
                return redirect()->route("business.buyAirtime");
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function walletAirtimePurchase($trxId)
    {
        $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
        $trx->payment_method = "Wallet Balance";
        $trx->save();

        $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

        if ($customerWallet->arete_balance < $trx->total_amount) {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->status = "Failed";
            $trx->save();

            toast("Your wallet balance is insufficient", 'error');
            return back();
        }

        $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
        $wallet->arete_balance = (double) ($wallet->arete_balance - $trx->total_amount);
        $wallet->save();

        try {
            $data = array(
                'serviceID' => $trx->biller == "9Mobile" ? 'etisalat' : strtolower($trx->biller),
                'amount' => (int) $trx->amount,
                'phone' => $trx->recipient,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Successful";
                $trx->save();

                $referralTrx = new ReferralTransaction;
                $referralTrx->customer_id = Auth::user()->id;
                $referralTrx->trx_type = "debit";
                $referralTrx->amount = $trx->total_amount;
                $referralTrx->details = "Airtime Purchase From " . $trx->biller;
                $referralTrx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new AirtimeSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    toast("Airtime Purchase Successful", 'success');
                    return redirect()->route("business.buyAirtime");
                }

            } else if ($result->code == "000" && $result->response_description == "TRANSACTION PROCESSING - PENDING") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                toast("Transaction is currently being processed", 'info');
                return redirect()->route("business.buyAirtime");
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->arete_balance = (double) ($wallet->arete_balance + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                toast("Airtime Purchase Failed", 'error');
                return redirect()->route("business.buyAirtime");
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function buyData()
    {
        if (Session::has("dataStatus")) {
            if (Session::get("dataStatus") == "successful") {
                toast("Data Purchase Successful", 'success');

            } else if (Session::get("dataStatus") == "pending") {
                toast("Transaction is currently being processed", 'info');
            } else {
                toast("Data Purchase Failed", 'error');
            }
        }
        return redirect()->route('business.data.plans', ["mtn-data"]);
    }

    public function retrieveDataPlans($serviceId)
    {

        $dataProviders = DataProvider::where("status", "Active")->get();
        $provida = DataProvider::where("service_id", $serviceId)->first();

        return view("business.buy_data", compact("dataProviders", "provida"));
    }

    public function dataPurchasePreview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'biller' => 'required',
            'phone_number' => 'required',
            'data_plan' => 'required',
            'variation' => 'required',
            'subscription_fee' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = DataProvider::find($request->biller);
        $topupAmount = abs(preg_replace("/,/", "", $request->subscription_fee));

        $transaction = new UtilityTransactions;
        $transaction->customer_id = Auth::user()->id;
        $transaction->transaction_id = $this->genTrxId();
        $transaction->reference = $this->generateVTPassReference();
        $transaction->trx_type = "Data";
        $transaction->biller = $provider->biller;
        $transaction->service_id = $provider->service_id;
        $transaction->recipient = $request->phone_number;
        $transaction->variation_code = $request->variation;
        $transaction->plan_details = $request->data_plan;
        $transaction->amount = $topupAmount;
        $transaction->fee = $provider->fee;
        $transaction->total_amount = (double) ($topupAmount + $provider->fee);
        if ($transaction->save()) {
            return redirect()->route("business.dataPreview", [$transaction->transaction_id]);
        } else {
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function dataPreview($trxId)
    {
        $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
        return view("business.data_preview", compact("trx"));
    }

    public function pointsDataPurchase($trxId)
    {
        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Bonus Balance";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->referral_points < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                toast("Your bonus balance is insufficient", 'error');
                return back();
            }

            $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
            $wallet->referral_points = (double) ($wallet->referral_points - $trx->total_amount);
            $wallet->save();

            $data = array(
                'serviceID' => $trx->service_id,
                'amount' => (int) $trx->amount,
                'phone' => $trx->recipient, //"08011111111",
                'variation_code' => $trx->variation_code,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Successful";
                $trx->save();

                $referralTrx = new ReferralTransaction;
                $referralTrx->customer_id = Auth::user()->id;
                $referralTrx->trx_type = "debit";
                $referralTrx->amount = $trx->total_amount;
                $referralTrx->details = "Data Subscription Purchase For " . $trx->plan_details;
                $referralTrx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new DataSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    Session::flash("dataStatus", "successful");
                    return redirect()->route("business.buyData");
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                Session::flash("dataStatus", "failed");
                return redirect()->route("business.buyData");
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                Session::flash("dataStatus", "pending");
                return redirect()->route("business.buyData");
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    public function walletDataPurchase($trxId)
    {
        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Wallet Balance";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->arete_balance < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                toast("Your wallet balance is insufficient", 'error');
                return back();
            }

            $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
            $wallet->arete_balance = (double) ($wallet->arete_balance - $trx->total_amount);
            $wallet->save();

            $data = array(
                'serviceID' => $trx->service_id,
                'amount' => (int) $trx->amount,
                'phone' => $trx->recipient, //"08011111111",
                'variation_code' => $trx->variation_code,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Successful";
                $trx->save();

                $referralTrx = new ReferralTransaction;
                $referralTrx->customer_id = Auth::user()->id;
                $referralTrx->trx_type = "debit";
                $referralTrx->amount = $trx->total_amount;
                $referralTrx->details = "Data Subscription Purchase For " . $trx->plan_details;
                $referralTrx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new DataSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    Session::flash("dataStatus", "successful");
                    return redirect()->route("business.buyData");
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->arete_balance = (double) ($wallet->arete_balance + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                Session::flash("dataStatus", "failed");
                return redirect()->route("business.buyData");
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                Session::flash("dataStatus", "pending");
                return redirect()->route("business.buyData");
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    public function buyCable()
    {
        if (Session::has("cableStatus")) {
            if (Session::get("cableStatus") == "successful") {
                toast("Cable Subscription Purchased Successful", 'success');

            } else if (Session::get("cableStatus") == "pending") {
                toast("Transaction is currently being processed", 'info');
            } else {
                toast("Cable Subscription Purchase Failed", 'error');
            }
        }
        return redirect()->route('business.cable.plans', ["dstv"]);
    }

    public function retrieveCablePlans($serviceId)
    {

        $cableProviders = CableProvider::where("status", "Active")->get();
        $provida = CableProvider::where("service_id", $serviceId)->first();

        return view("business.buy_cable", compact("cableProviders", "provida"));
    }

    public function cablePurchasePreview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'biller' => 'required',
            'iuc_number' => 'required',
            'bouquet' => 'required',
            'variation' => 'required',
            'subscription_fee' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = CableProvider::where("biller", $request->biller)->first();
        $topupAmount = abs(preg_replace("/,/", "", $request->subscription_fee));

        try {
            $data = array(
                'serviceID' => $provider->service_id,
                'billersCode' => $request->iuc_number, //"1212121212",
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/merchant-verify");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && isset($result->content->Customer_Name)) {
                $transaction = new UtilityTransactions;
                $transaction->customer_id = Auth::user()->id;
                $transaction->transaction_id = $this->genTrxId();
                $transaction->reference = $this->generateVTPassReference();
                $transaction->trx_type = "Cable";
                $transaction->biller = $provider->biller;
                $transaction->service_id = $provider->service_id;
                $transaction->recipient = $request->iuc_number;
                $transaction->recipient_name = $result->content->Customer_Name;
                $transaction->variation_code = $request->variation;
                $transaction->plan_details = $request->bouquet;
                $transaction->amount = $topupAmount;
                $transaction->fee = $provider->fee;
                $transaction->total_amount = (double) ($topupAmount + $provider->fee);
                $transaction->status = "Initiated";
                if ($transaction->save()) {
                    return redirect()->route("business.cablePreview", [$transaction->transaction_id]);
                } else {
                    toast("Unable To Initiate Data Subscription Purchase", 'error');
                    return back();
                }
            } else {
                toast("Unable To Initiate Data Subscription Purchase", 'error');
                return back();
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    public function cablePreview($trxId)
    {
        $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
        return view("business.cable_preview", compact("trx"));
    }

    public function pointsCablePurchase($trxId)
    {
        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Bonus Balance";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->referral_points < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                toast("Your bonus balance is insufficient", 'error');
                return back();
            }

            $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
            $wallet->referral_points = (double) ($wallet->referral_points - $trx->total_amount);
            $wallet->save();

            $data = array(
                'serviceID' => $trx->service_id,
                'amount' => (int) $trx->amount,
                'phone' => Auth::user()->phone == null ? '08188664322' : Auth::user()->phone,
                'billersCode' => $trx->recipient, //"1212121212",
                'variation_code' => $trx->variation_code,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Successful";
                $trx->save();

                $referralTrx = new ReferralTransaction;
                $referralTrx->customer_id = Auth::user()->id;
                $referralTrx->trx_type = "debit";
                $referralTrx->amount = $trx->total_amount;
                $referralTrx->details = "Cable Subscription Purchase For " . $trx->plan_details;
                $referralTrx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new CableSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    Session::flash("cableStatus", "successful");
                    return redirect()->route("business.buyCable");
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                Session::flash("cableStatus", "failed");
                return redirect()->route("business.buyCable");
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                Session::flash("cableStatus", "pending");
                return redirect()->route("business.buyCable");
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function walletCablePurchase($trxId)
    {
        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Wallet Balance";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->arete_balance < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                toast("Your wallet balance is insufficient", 'error');
                return back();
            }

            $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
            $wallet->arete_balance = (double) ($wallet->arete_balance - $trx->total_amount);
            $wallet->save();

            $data = array(
                'serviceID' => $trx->service_id,
                'amount' => (int) $trx->amount,
                'phone' => Auth::user()->phone == null ? '08188664322' : Auth::user()->phone,
                'billersCode' => $trx->recipient, //"1212121212",
                'variation_code' => $trx->variation_code,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Successful";
                $trx->save();

                $referralTrx = new ReferralTransaction;
                $referralTrx->customer_id = Auth::user()->id;
                $referralTrx->trx_type = "debit";
                $referralTrx->amount = $trx->total_amount;
                $referralTrx->details = "Cable Subscription Purchase For " . $trx->plan_details;
                $referralTrx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new CableSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    Session::flash("cableStatus", "successful");
                    return redirect()->route("business.buyCable");
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->arete_balance = (double) ($wallet->arete_balance + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                Session::flash("cableStatus", "failed");
                return redirect()->route("business.buyCable");
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                Session::flash("cableStatus", "pending");
                return redirect()->route("business.buyCable");
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function buyElectricity()
    {
        $electricityProviders = ElectricityProviders::where("status", "Active")->get();
        $provida = ElectricityProviders::where("status", "Active")->first();
        return view("business.buy_electricity", compact("electricityProviders", "provida"));
    }

    public function electricityPurchasePreview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id' => 'required',
            'meter_number' => 'required',
            'recharge_amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = ElectricityProviders::where("service_id", $request->service_id)->first();
        $topupAmount = abs(preg_replace("/,/", "", $request->recharge_amount));

        if ($topupAmount < 1000) {
            return new JsonResponse([
                'response' => [
                    'message' => 'Unable To Initiate Electricity Purchase',
                    'details' => 'Minumim recharge amount for electricity is NGN1,000',
                ],
            ], 400);
        }

        try {
            $data = array(
                'serviceID' => $provider->service_id,
                'billersCode' => $request->meter_number, //"1111111111111",
                'type' => "prepaid",
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/merchant-verify");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && isset($result->content->Customer_Name)) {
                $transaction = new UtilityTransactions;
                $transaction->customer_id = Auth::user()->id;
                $transaction->transaction_id = $this->genTrxId();
                $transaction->reference = $this->generateVTPassReference();
                $transaction->trx_type = "Electricity";
                $transaction->biller = $provider->biller . " (" . $provider->acronym . ")";
                $transaction->service_id = $provider->service_id;
                $transaction->recipient = $request->meter_number;
                $transaction->recipient_name = $result->content->Customer_Name;
                $transaction->recipient_address = isset($result->content->Address) ? $result->content->Address : null;
                $transaction->amount = $topupAmount;
                $transaction->fee = $provider->fee;
                $transaction->total_amount = (double) ($topupAmount + $provider->fee);
                $transaction->status = "Initiated";
                if ($transaction->save()) {
                    return redirect()->route("business.electricityPreview", [$transaction->transaction_id]);
                } else {
                    toast("Unable to verify Meter Number", 'error');
                    return back();
                }
            } else {
                toast("Unable to verify Meter Number", 'error');
                return back();
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function electricityPreview($trxId)
    {
        $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
        return view("business.electricity_preview", compact("trx"));
    }

    public function pointsElectricityPurchase($trxId)
    {
        try {

            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Bonus Balance";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->referral_points < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                toast("Your bonus balance is insufficient", 'error');
                return back();
            }

            $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
            $wallet->referral_points = (double) ($wallet->referral_points - $trx->total_amount);
            $wallet->save();

            $data = array(
                'serviceID' => $trx->service_id,
                'amount' => (int) $trx->amount,
                'billersCode' => $trx->recipient, //"1111111111111",
                'variation_code' => "prepaid",
                'phone' => Auth::user()->phone == null ? '08188664322' : Auth::user()->phone,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->token = isset($result->Token) ? $result->Token : $result->mainToken;
                $trx->units = isset($result->TariffRate) ? $result->TariffRate : (isset($result->mainTokenUnits) ? $result->mainTokenUnits : $result->Units);
                $trx->recipient_address = isset($result->Address) ? $result->Address : (isset($result->CustomerAddress) ? $result->CustomerAddress : null);
                $trx->status = "Successful";
                $trx->save();

                $referralTrx = new ReferralTransaction;
                $referralTrx->customer_id = Auth::user()->id;
                $referralTrx->trx_type = "debit";
                $referralTrx->amount = $trx->total_amount;
                $referralTrx->details = "Electricity Units Purchase From " . $trx->biller;
                $referralTrx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new ElectricitySuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    toast("Electricity Purchase Successful", 'success');
                    return redirect()->route("business.buyElectricity");
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                toast("Electricity Purchase Failed", 'error');
                return redirect()->route("business.buyElectricity");
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                toast("Transaction is currently being processed", 'info');
                return redirect()->route("business.buyElectricity");
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function walletElectricityPurchase($trxId)
    {
        try {

            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Wallet Balance";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->arete_balance < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                toast("Your wallet balance is insufficient", 'error');
                return back();
            }

            $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
            $wallet->arete_balance = (double) ($wallet->arete_balance - $trx->total_amount);
            $wallet->save();

            $data = array(
                'serviceID' => $trx->service_id,
                'amount' => (int) $trx->amount,
                'billersCode' => $trx->recipient, //"1111111111111",
                'variation_code' => "prepaid",
                'phone' => Auth::user()->phone == null ? '08188664322' : Auth::user()->phone,
                'request_id' => $trx->reference,
            );

            $curl = curl_init(env('VTPASS_ENDPOINT') . "/api/pay");
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, env('VTPASS_PK') . ":" . env('VTPASS_SK'));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->token = isset($result->Token) ? $result->Token : $result->mainToken;
                $trx->units = isset($result->TariffRate) ? $result->TariffRate : (isset($result->mainTokenUnits) ? $result->mainTokenUnits : $result->Units);
                $trx->recipient_address = isset($result->Address) ? $result->Address : (isset($result->CustomerAddress) ? $result->CustomerAddress : null);
                $trx->status = "Successful";
                $trx->save();

                $referralTrx = new ReferralTransaction;
                $referralTrx->customer_id = Auth::user()->id;
                $referralTrx->trx_type = "debit";
                $referralTrx->amount = $trx->total_amount;
                $referralTrx->details = "Electricity Units Purchase From " . $trx->biller;
                $referralTrx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new ElectricitySuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    toast("Electricity Purchase Successful", 'success');
                    return redirect()->route("business.buyElectricity");
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->arete_balance = (double) ($wallet->arete_balance + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                toast("Electricity Purchase Failed", 'error');
                return redirect()->route("business.buyElectricity");
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                toast("Transaction is currently being processed", 'info');
                return redirect()->route("business.buyElectricity");
            }
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong", 'error');
            return back();
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
