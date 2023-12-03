<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\AirtimeSuccessful as AirtimeSuccessful;
use App\Mail\CableSuccessful as CableSuccessful;
use App\Mail\DataSuccessful as DataSuccessful;
use App\Mail\ElectricitySuccessful as ElectricitySuccessful;
use App\Models\AirtimeProviders;
use App\Models\CableProvider;
use App\Models\CardTransactions;
use App\Models\CustomerCards;
use App\Models\CustomerWallet;
use App\Models\DataProvider;
use App\Models\ElectricityProviders;
use App\Models\ReferralTransaction;
use App\Models\UtilityTransactions;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Mail;

class UtilityController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * airtimeProviders
     *
     * @return void
     */
    public function airtimeProviders()
    {
        $airtimeProviders = AirtimeProviders::where("status", "Active")->get();
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "airtime_providers" => $airtimeProviders,
                ],
            ],
        ], 200);
    }

    /**
     * initiateAirtimePurchase
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateAirtimePurchase(Request $request)
    {
        $validator = $this->validate($request, [
            'provider' => 'required',
            'phone_number' => 'required',
            'topup_amount' => 'required',
        ]);

        $provider = AirtimeProviders::where("biller", $request->provider)->first();
        $topupAmount = abs(preg_replace("/,/", "", $request->topup_amount));

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
        $transaction->status = "Initiated";
        if ($transaction->save()) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    "data" => [
                        "details" => $transaction,
                    ],
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something went wrong',
                ],
            ], 400);
        }
    }

    /**
     * buyAirtime
     *
     * @param Request request
     *
     * @return void
     */
    public function buyAirtime(Request $request)
    {
        $validator = $this->validate($request, [
            'transaction_id' => 'required',
            'payment_method' => 'required',
        ]);

        if ($request->payment_method == "Referral Points") {
            return $this->airtimeWalletPayment($request->transaction_id);
        } else {
            $validator = $this->validate($request, [
                'card_id' => 'required|numeric',
            ]);
            return $this->airtimeCardPayment($request->transaction_id, $request->card_id);
        }
    }

    /**
     * airtimeWalletPayment
     *
     * @param mixed trxId
     *
     * @return void
     */
    public function airtimeWalletPayment($trxId)
    {
        try {

            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Referral Points";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->referral_points < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Your referral points balance is insufficient',
                    ],
                ], 400);
            }

            $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
            $wallet->referral_points = (double) ($wallet->referral_points - $trx->total_amount);
            $wallet->save();

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
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => [
                                    "customer_id" => $trx->customer_id,
                                    "transaction_id" => $trx->transaction_id,
                                    "reference" => $trx->reference,
                                    "trx_type" => $trx->trx_type,
                                    "biller" => $trx->biller,
                                    "amount" => $trx->amount,
                                    "recipient" => $trx->recipient,
                                    "fee" => $trx->fee,
                                    "total_amount" => $trx->total_amount,
                                    "payment_method" => $trx->payment_method,
                                    "status" => $trx->status,
                                    "created_at" => $trx->created_at,
                                ],
                            ],
                        ],
                    ], 200);
                }

            } else if ($result->code == "000" && $result->response_description == "TRANSACTION PROCESSING - PENDING") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "transaction_details" => [
                                "customer_id" => $trx->customer_id,
                                "transaction_id" => $trx->transaction_id,
                                "reference" => $trx->reference,
                                "trx_type" => $trx->trx_type,
                                "biller" => $trx->biller,
                                "amount" => $trx->amount,
                                "recipient" => $trx->recipient,
                                "fee" => $trx->fee,
                                "total_amount" => $trx->total_amount,
                                "payment_method" => $trx->payment_method,
                                "status" => $trx->status,
                                "created_at" => $trx->created_at,
                            ],
                        ],
                    ],
                ], 200);
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to process request',
                    ],
                ], 400);
            }

        } catch (\Exception $e) {

            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something went wrong',
                ],
            ], 400);
        }
    }

    /**
     * airtimeCardPayment
     *
     * @param mixed trxId
     *
     * @return void
     */
    public function airtimeCardPayment($trxId, $cardId)
    {

        $status = $this->chargeCardWithAuthorization($cardId, $trxId);

        if ($status === false) {
            $transaction = UtilityTransactions::where("transaction_id", $trxId)->first();
            $transaction->status = "Failed";
            $transaction->card_id = $cardId;
            $transaction->save();

            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    'data' => [
                        "transaction_details" => [
                            "customer_id" => $transaction->customer_id,
                            "transaction_id" => $transaction->transaction_id,
                            "reference" => $transaction->reference,
                            "trx_type" => $transaction->trx_type,
                            "biller" => $transaction->biller,
                            "amount" => $transaction->amount,
                            "recipient" => $transaction->recipient,
                            "fee" => $transaction->fee,
                            "total_amount" => $transaction->total_amount,
                            "payment_method" => $transaction->payment_method,
                            "status" => $transaction->status,
                            "created_at" => $transaction->created_at,
                        ],
                    ],
                ],
            ], 200);
        }

        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

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
                $trx->card_id = $cardId;
                $trx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new AirtimeSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => [
                                    "customer_id" => $trx->customer_id,
                                    "transaction_id" => $trx->transaction_id,
                                    "reference" => $trx->reference,
                                    "trx_type" => $trx->trx_type,
                                    "biller" => $trx->biller,
                                    "amount" => $trx->amount,
                                    "recipient" => $trx->recipient,
                                    "fee" => $trx->fee,
                                    "total_amount" => $trx->total_amount,
                                    "payment_method" => $trx->payment_method,
                                    "status" => $trx->status,
                                    "created_at" => $trx->created_at,
                                ],
                            ],
                        ],
                    ], 200);
                }

            } else if ($result->code == "000" && $result->response_description == "TRANSACTION PROCESSING - PENDING") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->card_id = $cardId;
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "transaction_details" => [
                                "customer_id" => $trx->customer_id,
                                "transaction_id" => $trx->transaction_id,
                                "reference" => $trx->reference,
                                "trx_type" => $trx->trx_type,
                                "biller" => $trx->biller,
                                "amount" => $trx->amount,
                                "recipient" => $trx->recipient,
                                "fee" => $trx->fee,
                                "total_amount" => $trx->total_amount,
                                "payment_method" => $trx->payment_method,
                                "status" => $trx->status,
                                "created_at" => $trx->created_at,
                            ],
                        ],
                    ],
                ], 200);
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->card_id = $cardId;
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to process request',
                    ],
                ], 400);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Airtime Purchase Failed',
                ],
            ], 400);
        }
    }

    /**
     * dataProviders
     *
     * @return void
     */
    public function dataProviders()
    {
        $dataProviders = DataProvider::where("status", "Active")->get();
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "data_providers" => $dataProviders,
                ],
            ],
        ], 200);
    }

    /**
     * dataPlans
     *
     * @param Request request
     *
     * @return void
     */
    public function dataPlans(Request $request)
    {
        $validator = $this->validate($request, [
            'service_id' => 'required',
        ]);

        try {
            $provider = DataProvider::where("service_id", $request->service_id)->first();

            $curl = curl_init();

            curl_setopt_array($curl, array(

                CURLOPT_URL => env('VTPASS_ENDPOINT') . "/api/service-variations?serviceID=" . $provider->service_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->response_description == "000") {
                $dataPlans = Collect($result->content->varations);

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "provider" => $provider,
                            "data_plans" => $dataPlans,
                        ],
                    ],
                ], 200);

            } else {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Retrieving Data Plans Failed',
                    ],
                ], 400);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something went wrong',
                ],
            ], 400);
        }

    }

    /**
     * initiateDataPurchase
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateDataPurchase(Request $request)
    {
        $validator = $this->validate($request, [
            'provider' => 'required',
            'phone_number' => 'required',
            'data_plan' => 'required',
            'variation' => 'required',
            'subscription_fee' => 'required',
        ]);

        $provider = DataProvider::where("biller", $request->provider)->first();
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
        $transaction->status = "Initiated";
        if ($transaction->save()) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    "data" => [
                        "transaction_details" => $transaction,
                    ],
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Unable To Initiate Data Purchase',
                ],
            ], 400);
        }
    }

    /**
     * buyData
     *
     * @param Request request
     *
     * @return void
     */
    public function buyData(Request $request)
    {
        $validator = $this->validate($request, [
            'transaction_id' => 'required',
            'payment_method' => 'required',
        ]);

        if ($request->payment_method == "Referral Points") {
            return $this->dataWalletPayment($request->transaction_id);
        } else {
            $validator = $this->validate($request, [
                'card_id' => 'required|numeric',
            ]);
            return $this->dataCardPayment($request->transaction_id, $request->card_id);
        }
    }

    /**
     * dataWalletPayment
     *
     * @param mixed trxId
     *
     * @return void
     */
    public function dataWalletPayment($trxId)
    {
        try {

            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Referral Points";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->referral_points < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Your referral points balance is insufficient',
                    ],
                ], 400);
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
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => [
                                    "customer_id" => $trx->customer_id,
                                    "transaction_id" => $trx->transaction_id,
                                    "reference" => $trx->reference,
                                    "trx_type" => $trx->trx_type,
                                    "biller" => $trx->biller,
                                    "service_id" => $trx->service_id,
                                    "recipient" => $trx->recipient,
                                    "variation_code" => $trx->variation_code,
                                    "plan_details" => $trx->plan_details,
                                    "amount" => $trx->amount,
                                    "fee" => $trx->fee,
                                    "total_amount" => $trx->total_amount,
                                    "payment_method" => $trx->payment_method,
                                    "status" => $trx->status,
                                    "created_at" => $trx->created_at,
                                ],
                            ],
                        ],
                    ], 200);
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to process request',
                    ],
                ], 400);
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "transaction_details" => [
                                "customer_id" => $trx->customer_id,
                                "transaction_id" => $trx->transaction_id,
                                "reference" => $trx->reference,
                                "trx_type" => $trx->trx_type,
                                "biller" => $trx->biller,
                                "service_id" => $trx->service_id,
                                "recipient" => $trx->recipient,
                                "variation_code" => $trx->variation_code,
                                "plan_details" => $trx->plan_details,
                                "amount" => $trx->amount,
                                "fee" => $trx->fee,
                                "total_amount" => $trx->total_amount,
                                "payment_method" => $trx->payment_method,
                                "status" => $trx->status,
                                "created_at" => $trx->created_at,
                            ],
                        ],
                    ],
                ], 200);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Data Purchase Failed',
                ],
            ], 400);
        }
    }

    /**
     * dataCardPayment
     *
     * @param mixed trxId
     *
     * @return void
     */
    public function dataCardPayment($trxId, $cardId)
    {

        $status = $this->chargeCardWithAuthorization($cardId, $trxId);

        if ($status === false) {
            $transaction = UtilityTransactions::where("transaction_id", $trxId)->first();
            $transaction->status = "Failed";
            $transaction->card_id = $cardId;
            $transaction->save();

            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Data Purchase Failed',
                ],
            ], 400);
        }

        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

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
                $trx->card_id = $cardId;
                $trx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new DataSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => [
                                    "customer_id" => $trx->customer_id,
                                    "transaction_id" => $trx->transaction_id,
                                    "reference" => $trx->reference,
                                    "trx_type" => $trx->trx_type,
                                    "biller" => $trx->biller,
                                    "service_id" => $trx->service_id,
                                    "recipient" => $trx->recipient,
                                    "variation_code" => $trx->variation_code,
                                    "plan_details" => $trx->plan_details,
                                    "amount" => $trx->amount,
                                    "fee" => $trx->fee,
                                    "total_amount" => $trx->total_amount,
                                    "payment_method" => $trx->payment_method,
                                    "status" => $trx->status,
                                    "created_at" => $trx->created_at,
                                ],
                            ],
                        ],
                    ], 200);
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->card_id = $cardId;
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to process request',
                    ],
                ], 400);
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->card_id = $cardId;
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "transaction_details" => [
                                "customer_id" => $trx->customer_id,
                                "transaction_id" => $trx->transaction_id,
                                "reference" => $trx->reference,
                                "trx_type" => $trx->trx_type,
                                "biller" => $trx->biller,
                                "service_id" => $trx->service_id,
                                "recipient" => $trx->recipient,
                                "variation_code" => $trx->variation_code,
                                "plan_details" => $trx->plan_details,
                                "amount" => $trx->amount,
                                "fee" => $trx->fee,
                                "total_amount" => $trx->total_amount,
                                "payment_method" => $trx->payment_method,
                                "status" => $trx->status,
                                "created_at" => $trx->created_at,
                            ],
                        ],
                    ],
                ], 200);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Data Purchase Failed',
                ],
            ], 400);
        }
    }

    /**
     * electricityProviders
     *
     * @return void
     */
    public function electricityProviders()
    {
        $electricityProviders = ElectricityProviders::where("status", "Active")->get();
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "electricity_providers" => $electricityProviders,
                ],
            ],
        ], 200);
    }

    /**
     * initiateElectricityPurchase
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateElectricityPurchase(Request $request)
    {
        $validator = $this->validate($request, [
            'service_id' => 'required',
            'meter_number' => 'required',
            'topup_amount' => 'required',
        ]);

        $provider = ElectricityProviders::where("service_id", $request->service_id)->first();
        $topupAmount = abs(preg_replace("/,/", "", $request->topup_amount));

        if ($topupAmount < 1000) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Minumim recharge amount for electricity is NGN1,000',
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
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => $transaction,
                            ],
                        ],
                    ], 200);
                } else {
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 400,
                            'status' => "Failed",
                            'message' => 'Unable To Initiate Electricity Purchase',
                        ],
                    ], 400);
                }
            } else {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to verify Meter Number',
                    ],
                ], 400);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Unable To Initiate Electricity Purchase',
                ],
            ], 400);
        }

    }

    /**
     * buyElectricity
     *
     * @param Request request
     *
     * @return void
     */
    public function buyElectricity(Request $request)
    {
        $validator = $this->validate($request, [
            'transaction_id' => 'required',
            'payment_method' => 'required',
        ]);

        if ($request->payment_method == "Referral Points") {
            return $this->electricityWalletPayment($request->transaction_id);
        } else {
            $validator = $this->validate($request, [
                'card_id' => 'required|numeric',
            ]);
            return $this->electricityCardPayment($request->transaction_id, $request->card_id);
        }
    }

    /**
     * electricityWalletPayment
     *
     * @param mixed trxId
     *
     * @return void
     */
    public function electricityWalletPayment($trxId)
    {
        try {

            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Referral Points";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->referral_points < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Your referral points balance is insufficient',
                    ],
                ], 400);
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

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL" && isset($result->token)) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->token = $result->token;
                $trx->units = isset($result->units) ? $result->units : null;
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
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => [
                                    "customer_id" => $trx->customer_id,
                                    "transaction_id" => $trx->transaction_id,
                                    "reference" => $trx->reference,
                                    "trx_type" => $trx->trx_type,
                                    "biller" => $trx->biller,
                                    "service_id" => $trx->service_id,
                                    "recipient" => $trx->recipient,
                                    "recipient_name" => $trx->recipient_name,
                                    "recipient_address" => $trx->recipient_address,
                                    "amount" => $trx->amount,
                                    "fee" => $trx->fee,
                                    "total_amount" => $trx->total_amount,
                                    "payment_method" => $trx->payment_method,
                                    "token" => $trx->token,
                                    "units" => $trx->units,
                                    "status" => $trx->status,
                                    "created_at" => $trx->created_at,
                                ],
                            ],
                        ],
                    ], 200);
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to process request',
                    ],
                ], 400);
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "transaction_details" => [
                                "customer_id" => $trx->customer_id,
                                "transaction_id" => $trx->transaction_id,
                                "reference" => $trx->reference,
                                "trx_type" => $trx->trx_type,
                                "biller" => $trx->biller,
                                "service_id" => $trx->service_id,
                                "recipient" => $trx->recipient,
                                "recipient_name" => $trx->recipient_name,
                                "recipient_address" => $trx->recipient_address,
                                "amount" => $trx->amount,
                                "fee" => $trx->fee,
                                "total_amount" => $trx->total_amount,
                                "payment_method" => $trx->payment_method,
                                "status" => $trx->status,
                                "created_at" => $trx->created_at,
                            ],
                        ],
                    ],
                ], 200);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Electricity Purchase Failed',
                ],
            ], 400);
        }
    }

    /**
     * electricityCardPayment
     *
     * @param mixed trxId
     *
     * @return void
     */
    public function electricityCardPayment($trxId, $cardId)
    {

        $status = $this->chargeCardWithAuthorization($cardId, $trxId);

        if ($status === false) {
            $transaction = UtilityTransactions::where("transaction_id", $trxId)->first();
            $transaction->status = "Failed";
            $transaction->card_id = $cardId;
            $transaction->save();

            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Electricity Purchase Failed',
                ],
            ], 400);
        }

        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

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

            if ($result->code == "000" && $result->response_description == "TRANSACTION SUCCESSFUL" && isset($result->token)) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->token = $result->token;
                $trx->units = isset($result->units) ? $result->units : null;
                $trx->status = "Successful";
                $trx->card_id = $cardId;
                $trx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new ElectricitySuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => [
                                    "customer_id" => $trx->customer_id,
                                    "transaction_id" => $trx->transaction_id,
                                    "reference" => $trx->reference,
                                    "trx_type" => $trx->trx_type,
                                    "biller" => $trx->biller,
                                    "service_id" => $trx->service_id,
                                    "recipient" => $trx->recipient,
                                    "recipient_name" => $trx->recipient_name,
                                    "recipient_address" => $trx->recipient_address,
                                    "amount" => $trx->amount,
                                    "fee" => $trx->fee,
                                    "total_amount" => $trx->total_amount,
                                    "payment_method" => $trx->payment_method,
                                    "token" => $trx->token,
                                    "units" => $trx->units,
                                    "status" => $trx->status,
                                    "created_at" => $trx->created_at,
                                ],
                            ],
                        ],
                    ], 200);
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->card_id = $cardId;
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to process request',
                    ],
                ], 400);
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->card_id = $cardId;
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "transaction_details" => [
                                "customer_id" => $trx->customer_id,
                                "transaction_id" => $trx->transaction_id,
                                "reference" => $trx->reference,
                                "trx_type" => $trx->trx_type,
                                "biller" => $trx->biller,
                                "service_id" => $trx->service_id,
                                "recipient" => $trx->recipient,
                                "recipient_name" => $trx->recipient_name,
                                "recipient_address" => $trx->recipient_address,
                                "amount" => $trx->amount,
                                "fee" => $trx->fee,
                                "total_amount" => $trx->total_amount,
                                "payment_method" => $trx->payment_method,
                                "status" => $trx->status,
                                "created_at" => $trx->created_at,
                            ],
                        ],
                    ],
                ], 200);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Electricity Purchase Failed',
                ],
            ], 400);
        }
    }

    /**
     * cableProviders
     *
     * @return void
     */
    public function cableProviders()
    {
        $cableProviders = CableProvider::where("status", "Active")->get();
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "cable_providers" => $cableProviders,
                ],
            ],
        ], 200);
    }

    /**
     * cablePlans
     *
     * @param Request request
     *
     * @return void
     */
    public function cablePlans(Request $request)
    {
        $validator = $this->validate($request, [
            'service_id' => 'required',
        ]);

        try {

            $provider = CableProvider::where("service_id", $request->service_id)->first();

            $curl = curl_init();

            curl_setopt_array($curl, array(

                CURLOPT_URL => env('VTPASS_ENDPOINT') . "/api/service-variations?serviceID=" . $provider->service_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    // Set Here Your Requesred Headers
                    'Content-Type: application/json',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($response);

            if ($result->response_description == "000") {
                $bouquets = Collect($result->content->varations);
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "provider" => $provider,
                            "cable_plans" => $bouquets,
                        ],
                    ],
                ], 200);

            } else {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Retrieving Cable Plans Failed',
                    ],
                ], 400);
            }

        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Request Failed',
                ],
            ], 400);
        }

    }

    /**
     * initiateCablePurchase
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateCablePurchase(Request $request)
    {
        $validator = $this->validate($request, [
            'provider' => 'required',
            'iuc_number' => 'required',
            'cable_plan' => 'required',
            'variation' => 'required',
            'subscription_fee' => 'required',
        ]);

        $provider = CableProvider::where("biller", $request->provider)->first();
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
                $transaction->plan_details = $request->cable_plan;
                $transaction->amount = $topupAmount;
                $transaction->fee = $provider->fee;
                $transaction->total_amount = (double) ($topupAmount + $provider->fee);
                $transaction->status = "Initiated";
                if ($transaction->save()) {
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => $transaction,
                            ],
                        ],
                    ], 200);
                } else {
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 400,
                            'status' => "Failed",
                            'message' => 'Unable To Initiate Data Subscription Purchase',
                        ],
                    ], 400);
                }
            } else {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to verify IUC Number',
                    ],
                ], 400);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Unable To Initiate Data Subscription Purchase',
                ],
            ], 400);
        }

    }

    /**
     * buyData
     *
     * @param Request request
     *
     * @return void
     */
    public function buyCable(Request $request)
    {
        $validator = $this->validate($request, [
            'transaction_id' => 'required',
            'payment_method' => 'required',
        ]);

        if ($request->payment_method == "Referral Points") {
            return $this->cableWalletPayment($request->transaction_id);
        } else {
            $validator = $this->validate($request, [
                'card_id' => 'required|numeric',
            ]);
            return $this->cableCardPayment($request->transaction_id, $request->card_id);
        }
    }

    /**
     * cableWalletPayment
     *
     * @param mixed trxId
     *
     * @return void
     */
    public function cableWalletPayment($trxId)
    {
        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
            $trx->payment_method = "Referral Points";
            $trx->save();

            $customerWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

            if ($customerWallet->referral_points < $trx->total_amount) {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Failed";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Your referral points balance is insufficient',
                    ],
                ], 400);
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
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => [
                                    "customer_id" => $trx->customer_id,
                                    "transaction_id" => $trx->transaction_id,
                                    "reference" => $trx->reference,
                                    "trx_type" => $trx->trx_type,
                                    "biller" => $trx->biller,
                                    "service_id" => $trx->service_id,
                                    "recipient" => $trx->recipient,
                                    "recipient_name" => $trx->recipient_name,
                                    "variation_code" => $trx->variation_code,
                                    "plan_details" => $trx->plan_details,
                                    "amount" => $trx->amount,
                                    "fee" => $trx->fee,
                                    "total_amount" => $trx->total_amount,
                                    "payment_method" => $trx->payment_method,
                                    "status" => $trx->status,
                                    "created_at" => $trx->created_at,
                                ],
                            ],
                        ],
                    ], 200);
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to process request',
                    ],
                ], 400);
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "transaction_details" => [
                                "customer_id" => $trx->customer_id,
                                "transaction_id" => $trx->transaction_id,
                                "reference" => $trx->reference,
                                "trx_type" => $trx->trx_type,
                                "biller" => $trx->biller,
                                "service_id" => $trx->service_id,
                                "recipient" => $trx->recipient,
                                "recipient_name" => $trx->recipient_name,
                                "variation_code" => $trx->variation_code,
                                "plan_details" => $trx->plan_details,
                                "amount" => $trx->amount,
                                "fee" => $trx->fee,
                                "total_amount" => $trx->total_amount,
                                "payment_method" => $trx->payment_method,
                                "status" => $trx->status,
                                "created_at" => $trx->created_at,
                            ],
                        ],
                    ],
                ], 200);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Cable Subscription Purchase Failed',
                ],
            ], 400);
        }
    }

    /**
     * cableCardPayment
     *
     * @param mixed trxId
     * @param mixed status
     *
     * @return void
     */
    public function cableCardPayment($trxId, $cardId)
    {
        $status = $this->chargeCardWithAuthorization($cardId, $trxId);

        if ($status === false) {
            $transaction = UtilityTransactions::where("transaction_id", $trxId)->first();
            $transaction->status = "Failed";
            $transaction->card_id = $cardId;
            $transaction->save();

            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Cable Subscription Purchase Failed',
                ],
            ], 400);
        }

        try {
            $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

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
                $trx->card_id = $cardId;
                $trx->save();

                try {
                    $user = Auth::user();
                    Mail::to($user)->send(new CableSuccessful($user, $trx));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            "data" => [
                                "transaction_details" => [
                                    "customer_id" => $trx->customer_id,
                                    "transaction_id" => $trx->transaction_id,
                                    "reference" => $trx->reference,
                                    "trx_type" => $trx->trx_type,
                                    "biller" => $trx->biller,
                                    "service_id" => $trx->service_id,
                                    "recipient" => $trx->recipient,
                                    "recipient_name" => $trx->recipient_name,
                                    "variation_code" => $trx->variation_code,
                                    "plan_details" => $trx->plan_details,
                                    "amount" => $trx->amount,
                                    "fee" => $trx->fee,
                                    "total_amount" => $trx->total_amount,
                                    "payment_method" => $trx->payment_method,
                                    "status" => $trx->status,
                                    "created_at" => $trx->created_at,
                                ],
                            ],
                        ],
                    ], 200);
                }

            } else if ($result->code == "016" && $result->response_description == "TRANSACTION FAILED") {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();

                $wallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $wallet->referral_points = (double) ($wallet->referral_points + $trx->total_amount);
                $wallet->save();

                $trx->status = "Failed";
                $trx->card_id = $cardId;
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Unable to process request',
                    ],
                ], 400);
            } else {
                $trx = UtilityTransactions::where("transaction_id", $trxId)->first();
                $trx->status = "Pending";
                $trx->card_id = $cardId;
                $trx->save();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "transaction_details" => [
                                "customer_id" => $trx->customer_id,
                                "transaction_id" => $trx->transaction_id,
                                "reference" => $trx->reference,
                                "trx_type" => $trx->trx_type,
                                "biller" => $trx->biller,
                                "service_id" => $trx->service_id,
                                "recipient" => $trx->recipient,
                                "recipient_name" => $trx->recipient_name,
                                "variation_code" => $trx->variation_code,
                                "plan_details" => $trx->plan_details,
                                "amount" => $trx->amount,
                                "fee" => $trx->fee,
                                "total_amount" => $trx->total_amount,
                                "payment_method" => $trx->payment_method,
                                "status" => $trx->status,
                                "created_at" => $trx->created_at,
                            ],
                        ],
                    ],
                ], 200);
            }
        } catch (\Exception $e) {
            report($e);
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Cable Subscription Purchase Failed',
                ],
            ], 400);
        }
    }

    /**
     * utilityTransactions
     *
     * @return void
     */
    public function utilityTransactions()
    {
        $utilityTransactions = UtilityTransactions::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->get();
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "utility_transactions" => $utilityTransactions,
                ],
            ],
        ], 200);
    }

    /**
     * chargeCardWithAuthorization
     *
     * @param mixed cardId
     *
     * @return void
     */
    public function chargeCardWithAuthorization($cardId, $trxId)
    {
        $card = CustomerCards::where("id", $cardId)->where("customer_id", Auth::user()->id)->first();
        $transaction = UtilityTransactions::where("transaction_id", $trxId)->first();
        if (isset($card) && isset($transaction)) {
            $response = Http::accept('application/json')->withHeaders([
                'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
            ])->post("https://api.paystack.co/transaction/charge_authorization", [
                "authorization_code" => $card->authorization_code,
                "email" => Auth::user()->email,
                "amount" => ($transaction->total_amount * 100),
            ]);

            $resData = $response->json();

            if ($resData["status"] === true && $resData["data"]["status"] == "success") {

                $cardTrx = new CardTransactions;
                $cardTrx->customer_id = Auth::user()->id;
                $cardTrx->card_id = $cardId;
                $cardTrx->amount = $transaction->total_amount;
                $cardTrx->paystack_reference = $resData["data"]["reference"];
                $cardTrx->description = $this->getTransactionDescription($cardId, $trxId);
                if ($cardTrx->save()) {
                    return true;

                } else {
                    return false;

                }
            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    /**
     * getTransactionDescription
     *
     * @param mixed cardId
     * @param mixed trxId
     *
     * @return void
     */
    public function getTransactionDescription($cardId, $trxId)
    {
        $card = CustomerCards::find($cardId);
        $transaction = UtilityTransactions::where("transaction_id", $trxId)->first();
        if (isset($card) && isset($transaction)) {
            if ($transaction->trx_type == "Airtime") {
                $description = ucwords($card->card_brand) . " card: " . $card->last_four_digits . " - Airtime Purchase from " . $transaction->biller . " to Phone Number: " . $transaction->recipient;
                return $description;
            } else if ($transaction->trx_type == "Data") {
                $description = ucwords($card->card_brand) . " card: " . $card->last_four_digits . " - Data Purchase from " . $transaction->biller . " to Phone Number: " . $transaction->recipient;
                return $description;
            } else if ($transaction->trx_type == "Electricity") {
                $description = ucwords($card->card_brand) . " card: " . $card->last_four_digits . " - Electricity Units Purchase from " . $transaction->biller . " to Meter Number: " . $transaction->recipient;
                return $description;

            } else {
                $description = ucwords($card->card_brand) . " card: " . $card->last_four_digits . " - Cable Subscription Purchase from " . $transaction->biller . " to IUC Number: " . $transaction->recipient;
                return $description;
            }
        }

        return "NULL";
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
