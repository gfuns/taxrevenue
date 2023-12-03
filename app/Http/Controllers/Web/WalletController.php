<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AreteWalletTransaction;
use App\Models\CardTransactions;
use App\Models\CustomerCards;
use App\Models\CustomerWallet;
use App\Models\ReferralTransaction;
use Auth;
use Coderatio\PaystackMirror\Actions\Transactions\VerifyTransaction;
use Coderatio\PaystackMirror\PaystackMirror;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

class WalletController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * walletBalances
     *
     * @return void
     */
    public function walletBalances()
    {
        $walletBalance = CustomerWallet::where("customer_id", Auth::user()->id)->first();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'arete_wallet_balance' => (double) $walletBalance->arete_balance,
                'referral_points' => (double) $walletBalance->referral_points,
            ],
        ], 200);
    }

    /**
     * viewReferralPoints
     *
     * @return void
     */
    public function viewReferralPoints()
    {
        $walletBalance = CustomerWallet::where("customer_id", Auth::user()->id)->first();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'referral_points' => (double) $walletBalance->referral_points,
            ],
        ], 200);
    }

    /**
     * viewAreteBalance
     *
     * @return void
     */
    public function viewAreteBalance()
    {
        $walletBalance = CustomerWallet::where("customer_id", Auth::user()->id)->first();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'arete_wallet_balance' => (double) $walletBalance->arete_balance,
            ],
        ], 200);
    }

    /**
     * viewReferralTransactions
     *
     * @return void
     */
    public function viewReferralTransactions()
    {
        $transactions = ReferralTransaction::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->get();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'referral_transactions' => $transactions,
            ],
        ], 200);
    }

    /**
     * viewAreteTransactions
     *
     * @return void
     */
    public function viewAreteTransactions()
    {
        $transactions = AreteWalletTransaction::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->get();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'arete_transactions' => $transactions,
            ],
        ], 200);
    }

    /**
     * initiateCardAddition
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateCardAddition()
    {
        // $actionParams = new ParamsBuilder();
        // $actionParams->email = "sesegmegalead@gmail.com";
        // $actionParams->amount = (100 * 100);
        // $actionParams->reference = PaystackMirror::generateReference();

        // $result = PaystackMirror::run(env('PAYSTACK_SECRET_KEY'), new InitializeTransaction($actionParams));
        // $response = $result->getResponse()->asObject();

        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'paystack_reference' => PaystackMirror::generateReference(),
                'paystack_public_key' => env('PAYSTACK_PUBLIC_KEY'),
                // 'url' => $response->data->authorization_url,
            ],
        ], 200);
    }

    /**
     * addNewCard
     *
     * @param Request request
     *
     * @return void
     */
    public function addNewCard(Request $request)
    {
        $validator = $this->validate($request, [
            'paystack_reference' => 'required',
        ]);

        $payment = PaystackMirror::run(env('PAYSTACK_SECRET_KEY'), new VerifyTransaction($request->paystack_reference))
            ->getResponse()->asObject();

        $cardDetails = $payment->data->authorization;

        if (!isset($cardDetails)) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Verifying Card Information Failed',
                ],
            ], 400);
        }

        $newCard = new CustomerCards;
        $newCard->customer_id = Auth::user()->id;
        $newCard->authorization_code = encrypt($cardDetails->authorization_code);
        $newCard->last_four_digits = $cardDetails->last4;
        $newCard->expiry_month = $cardDetails->exp_month;
        $newCard->expiry_year = $cardDetails->exp_year;
        $newCard->card_brand = $cardDetails->brand;
        $newCard->issuing_bank = $cardDetails->bank;
        $newCard->card_holder = $cardDetails->account_name;
        if ($newCard->save()) {
            return new JsonResponse([
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'card_details' => $newCard,
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
     * viewStoredCards
     *
     * @return void
     */
    public function viewStoredCards()
    {
        $cards = CustomerCards::where("customer_id", Auth::user()->id)->get();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'cards' => $cards,
            ],
        ], 200);
    }

    /**
     * deleteCard
     *
     * @param Request request
     *
     * @return void
     */
    public function deleteCard(Request $request)
    {
        $validator = $this->validate($request, [
            'card_id' => 'required',
        ]);

        $card = CustomerCards::where("id", $request->card_id)->where("customer_id", Auth::user()->id)->first();
        if (isset($card)) {
            if ($card->delete()) {
                return new JsonResponse([
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    'data' => [
                        'message' => "Card deleted successfully",
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

        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Card with the provided card id does not exist on our records',
                ],
            ], 400);
        }
    }

    /**
     * depositFunds
     *
     * @param Request request
     *
     * @return void
     */
    public function fundAreteWallet(Request $request)
    {
        $validator = $this->validate($request, [
            'amount' => 'required|numeric',
            'card_id' => 'required',
        ]);

        $status = $this->chargeCardWithAuthorization($request->card_id, abs($request->amount));

        if ($status === true) {
            //Update Arete Wallet Balance and then create a transaction record
            try {
                DB::beginTransaction();

                $walletBalance = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                $walletBalance->arete_balance = (double) ($walletBalance->arete_balance + abs($request->amount));
                $walletBalance->save();

                $card = CustomerCards::find($request->card_id);

                $transaction = new AreteWalletTransaction;
                $transaction->customer_id = Auth::user()->id;
                $transaction->trx_type = "credit";
                $transaction->payment_method = "Card";
                $transaction->card_id = $request->card_id;
                $transaction->amount = abs($request->amount);
                $transaction->description = ucwords($card->card_brand) . " card:  " . $card->last_four_digits . " - Arete Wallet Funding";
                $transaction->save();

                DB::commit();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        'data' => [
                            'transaction_details' => $transaction,
                        ],
                    ],
                ], 200);

            } catch (\Exception $e) {
                report($e);

                DB::rollback();

                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Something Went Wrong',
                    ],
                ], 400);
            }
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Something Went Wrong',
                ],
            ], 400);
        }
    }

    /**
     * bankList
     *
     * @return void
     */
    public function bankList()
    {
        $response = Http::accept('application/json')->withHeaders([
            'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
        ])->get("https://api.paystack.co/bank", ["currency" => "NGN"]);

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'bank_list' => $response->collect("data"),
                ],
            ],
        ], 200);
    }

    /**
     * validateBankAccount
     *
     * @param Request request
     *
     * @return void
     */
    public function validateBankAccount(Request $request)
    {
        $validator = $this->validate($request, [
            'bank_code' => 'required|numeric',
            'account_number' => 'required',
        ]);

        $response = Http::accept('application/json')->withHeaders([
            'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
        ])->get("https://api.paystack.co/bank/resolve", ["account_number" => $request->account_number, "bank_code" => $request->bank_code]);

        $accountInfo = $response->json();

        if ($accountInfo["status"] === true) {
            $bankInfo = $response->collect("data");
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    'data' => [
                        'account_details' => [
                            "account_number" => $bankInfo["account_number"],
                            "account_name" => $bankInfo["account_name"],
                            "bank_id" => $bankInfo["bank_id"],
                            "bank_code" => $request->bank_code,
                        ],
                    ],
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => "Could not resolve account name. Check parameters or try again.",
                ],
            ], 400);
        }

    }

    /**
     * withdrawFunds
     *
     * @param Request request
     *
     * @return void
     */
    public function withdrawFunds(Request $request)
    {
        $validator = $this->validate($request, [
            'amount' => 'required|numeric',
            'bank_code' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
        ]);

        $areteWallet = CustomerWallet::where("customer_id", Auth::user()->id)->first();

        if (abs($request->amount) > $areteWallet->arete_balance) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => "Your Arete Wallet Balance cannot satisfy the withdrawal.",
                ],
            ], 400);
        }

        //Create Transfer Recipient

        $response = Http::accept('application/json')->withHeaders([
            'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
        ])->post("https://api.paystack.co/transferrecipient", [
            "type" => "nuban",
            "name" => $request->account_name,
            "account_number" => $request->account_number,
            "bank_code" => $request->bank_code,
            "currency" => "NGN",
        ]);

        $result = $response->json();

        if ($result["status"] === true) {
            $data = $response->collect("data");

            $recipient = $data["recipient_code"];
            $reference = Uuid::uuid4();

            //Initiate the Actual Transfer

            $response = Http::accept('application/json')->withHeaders([
                'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
            ])->post("https://api.paystack.co/transfer", [
                "source" => "balance",
                "reason" => "Customer Funds Withdrawal from Arete Nigeria",
                "amount" => (abs($request->amount) * 100),
                "recipient" => $recipient,
                "reference" => $reference,
            ]);

            $transferRes = $response->json();

            if ($transferRes["status"] === true) {
                $transferData = $response->collect("data");

                try {
                    DB::beginTransaction();

                    $walletBalance = CustomerWallet::where("customer_id", Auth::user()->id)->first();
                    $walletBalance->arete_balance = (double) ($walletBalance->arete_balance - abs($request->amount));
                    $walletBalance->save();

                    $transaction = new AreteWalletTransaction;
                    $transaction->customer_id = Auth::user()->id;
                    $transaction->trx_type = "debit";
                    $transaction->payment_method = "Wallet";
                    $transaction->amount = abs($request->amount);
                    $transaction->description = "Customer Withdrawal From Arete Wallet to " . $request->bank_name . " Account number: " . $request->account_number . " - " . $request->account_name;
                    $transaction->reference = $transferData["reference"];
                    $transaction->bank = $request->bank_name;
                    $transaction->account_number = $request->account_number;
                    $transaction->account_name = $request->account_name;
                    $transaction->save();

                    DB::commit();

                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            'data' => [
                                'transaction_details' => $transaction,
                            ],
                        ],
                    ], 200);
                } catch (\Exception $e) {
                    report($e);
                    DB::rollback();
                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 400,
                            'status' => "Failed",
                            'message' => "Please try again",
                        ],
                    ], 400);
                }

            } else {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => $transferRes["message"],
                    ],
                ], 400);
            }

        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => $result["message"],
                ],
            ], 400);
        }
    }

    /**
     * chargeCardWithAuthorization
     *
     * @param mixed cardId
     *
     * @return void
     */
    public function chargeCardWithAuthorization($cardId, $amount)
    {
        $card = CustomerCards::where("id", $cardId)->where("customer_id", Auth::user()->id)->first();
        if (isset($card)) {
            $response = Http::accept('application/json')->withHeaders([
                'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
            ])->post("https://api.paystack.co/transaction/charge_authorization", [
                "authorization_code" => $card->authorization_code,
                "email" => Auth::user()->email,
                "amount" => ($amount * 100),
            ]);

            $resData = $response->json();

            if ($resData["status"] === true && $resData["data"]["status"] == "success") {
                $cardTrx = new CardTransactions;
                $cardTrx->customer_id = Auth::user()->id;
                $cardTrx->card_id = $cardId;
                $cardTrx->amount = $amount;
                $cardTrx->paystack_reference = $resData["data"]["reference"];
                $cardTrx->description = ucwords($card->card_brand) . " card:  " . $card->last_four_digits . " - Arete Wallet Funding";
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
     * processFundsWithdrawal
     *
     * @param Request request
     *
     * @return void
     */
    public function processFundsWithdrawal($amount, $accountNumber, $bank)
    {
        return false;
    }

    /**
     * viewCardTransactions
     *
     * @return void
     */
    public function viewCardTransactions()
    {
        $transactions = CardTransactions::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->get();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'card_transactions' => $transactions,
            ],
        ], 200);
    }
}
