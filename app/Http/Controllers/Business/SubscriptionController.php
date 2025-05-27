<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\CardTransactions;
use App\Models\Customer;
use App\Models\CustomerCards;
use App\Models\CustomerSubscription;
use App\Models\CustomerWallet;
use App\Models\PaystackTransaction;
use App\Models\Referral;
use App\Models\ReferralTransaction;
use App\Models\SubscriptionPlan;
use Auth;
use Carbon\Carbon;
use Coderatio\PaystackMirror\Actions\Transactions\VerifyTransaction;
use Coderatio\PaystackMirror\PaystackMirror;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
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

    public function subscription()
    {
        $activeSubscription = CustomerSubscription::where("customer_id", Auth::user()->id)->where("status", "active")->first();
        $customerCards      = CustomerCards::where("customer_id", Auth::user()->id)->get();
        $transactions       = CustomerSubscription::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->get();
        return view("business.subscription", compact("activeSubscription", "customerCards", "transactions"));

        if (isset($activeSubscription)) {
            $customerCards = CustomerCards::where("customer_id", Auth::user()->id)->get();
            return view("business.subscription", compact("activeSubscription", "customerCards"));
        } else {
            return redirect()->route("business.subscribe");
        }
    }

    public function defaultCard($id)
    {
        try {

            DB::beginTransaction();

            CustomerCards::where('customer_id', Auth::user()->id)->where("default_card", 1)->update([
                'default_card' => 0,
            ]);

            $card = CustomerCards::where("id", $id)->where("customer_id", Auth::user()->id)->first();
            if (isset($card)) {
                $card->default_card = 1;
                $card->save();

                DB::commit();

                toast('Primary Card Set Successfully.', 'success');
                return back();
            } else {
                toast('Something went wrong.', 'error');
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();

            report($e);

            toast('Something went wrong.', 'error');
            return back();
        }
    }

    public function deleteCard($id)
    {
        $card = CustomerCards::find($id);
        if (isset($card)) {
            if ($card->default_card == 0) {
                if ($card->delete()) {
                    toast('Card Details Deleted Successfully.', 'success');
                    return back();
                } else {
                    toast('Something went wrong.', 'error');
                    return back();
                }
            } else {
                toast('You must have atleast one Primary Payment Method on your account.', 'error');
                return back();
            }

        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    public function initiateSubscription()
    {
        $subscriptionPlans = SubscriptionPlan::where("id", ">", 1)->get();
        $customerCards     = CustomerCards::where("customer_id", Auth::user()->id)->get();
        if (count($customerCards) > 0) {

            $primaryCard = CustomerCards::where("customer_id", Auth::user()->id)->where("default_card", 1)->first();

            if (! isset($primaryCard)) {
                $primaryCard = CustomerCards::where("customer_id", Auth::user()->id)->first();
            }

            return view("business.initiate_subscription", compact("subscriptionPlans", "primaryCard"));
        } else {
            toast('You do not have a payment method on file. Please add your preferred payment method', 'error');
            return back();
        }

    }

    public function previewSubscription($id)
    {
        $plan = SubscriptionPlan::find($id);
        if (isset($plan)) {
            $customerCards = CustomerCards::where("customer_id", Auth::user()->id)->get();
            return view("business.subscription_preview", compact("plan", "customerCards"));
        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    public function processSubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
            'card_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $plan = SubscriptionPlan::find($request->plan_id);
        $card = CustomerCards::find($request->card_id);
        if (isset($plan) && isset($card)) {
            $status = $this->chargeCardWithAuthorization($request->card_id, $request->plan_id);

            if ($status === true) {
                try {
                    DB::beginTransaction();

                    CustomerSubscription::where("customer_id", Auth::user()->id)->update([
                        "status" => "inactive",
                    ]);

                    $subscription                      = new CustomerSubscription;
                    $subscription->customer_id         = Auth::user()->id;
                    $subscription->plan_id             = $plan->id;
                    $subscription->card_details        = ucwords($card->card_brand) . " ending with " . $card->last_four_digits;
                    $subscription->subscription_amount = $plan->billing_amount;
                    $subscription->auto_renew          = 1;
                    $subscription->status              = "active";
                    $subscription->next_due_date       = Carbon::now()->addDays($plan->duration);
                    $subscription->save();

                    //We Activate his Business Page
                    Business::where("customer_id", Auth::user()->id)->update([
                        "visibility" => 1,
                    ]);

                    $referral = Referral::where("referral_id", Auth::user()->id)->first();
                    if (isset($referral)) {
                        $referralSubscribed = CustomerSubscription::where("customer_id", $referral->customer_id)->where("status", "active")->first();
                        if (isset($referralSubscribed)) {
                            $bonus    = ((5 / 100) * $plan->billing_amount);
                            $customer = Customer::find($referral->customer_id);

                            $transaction                 = new ReferralTransaction;
                            $transaction->customer_id    = $referral->customer_id;
                            $transaction->trx_type       = "credit";
                            $transaction->amount         = $bonus;
                            $transaction->details        = "Bonus received from subcription made by " . Auth::user()->first_name . " " . Auth::user()->last_name;
                            $transaction->balance_before = $customer->wallet->referral_points;
                            $transaction->balance_after  = ($customer->wallet->referral_points + $bonus);
                            $transaction->save();

                            $customerWallet                  = CustomerWallet::where("customer_id", $referral->customer_id)->first();
                            $customerWallet->referral_points = (double) ($customerWallet->referral_points + $bonus);
                            $customerWallet->save();
                        }
                    }
                    DB::commit();

                    toast('Subscription Successful.', 'success');
                    return redirect()->route("business.subscription");

                } catch (\Exception $e) {
                    DB::rollback();
                    report($e);

                    toast('Something went wrong.', 'error');
                    return back();
                }
            } else {
                toast('Something went wrong.', 'error');
                return back();
            }
        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    /**
     * chargeCardWithAuthorization
     *
     * @param mixed cardId
     *
     * @return void
     */
    public function chargeCardWithAuthorization($cardId, $planId)
    {
        try {

            $plan = SubscriptionPlan::find($planId);
            $card = CustomerCards::where("id", $cardId)->where("customer_id", Auth::user()->id)->first();
            if (isset($plan) && isset($card)) {
                $response = Http::accept('application/json')->withHeaders([
                    'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                ])->post("https://api.paystack.co/transaction/charge_authorization", [
                    "authorization_code" => $card->authorization_code,
                    "email"              => Auth::user()->email,
                    "amount"             => ($plan->billing_amount * 100),
                ]);

                $resData = $response->json();

                if ($resData["status"] === true && $resData["data"]["status"] == "success") {
                    $cardTrx                     = new CardTransactions;
                    $cardTrx->customer_id        = Auth::user()->id;
                    $cardTrx->card_details       = ucwords($card->card_brand) . " ending with " . $card->last_four_digits;
                    $cardTrx->amount             = $plan->billing_amount;
                    $cardTrx->paystack_reference = $resData["data"]["reference"];
                    $cardTrx->description        = ucwords($card->card_brand) . " card:  " . $card->last_four_digits . " - Customer Subscription to " . $plan->plan . " Plan (" . $plan->duration . " Days)";
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
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            toast('We encountered an error while trying to connect with your card provider. Please Try again after some time', 'error');
            return back();
        }

    }

    public function setAutoRenewal(Request $request)
    {

        CustomerSubscription::where('customer_id', Auth::user()->id)->where("id", $request->param)->update([
            'auto_renew' => $request->status,
        ]);

        return response()->json(['status' => 200, 'message' => 'Autorenew status updated successfully.']);

    }

    public function initiateCardAddition(Request $request)
    {
        $transaction              = new PaystackTransaction;
        $transaction->customer_id = Auth::user()->id;
        $transaction->trx_type    = "paymentmethod";
        $transaction->reference   = "pm_rf" . Str::random(11);
        $transaction->amount      = 100;
        if ($transaction->save()) {
            $response = Http::accept('application/json')->withHeaders([
                'authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
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
    }

    public function handlePaystackCallback(Request $request)
    {
        $payment = PaystackMirror::run(env('PAYSTACK_SECRET_KEY'), new VerifyTransaction($request->reference))
            ->getResponse()->asObject();

        if (! isset($payment->data)) {
            toast("Something Went Wrong", 'error');
            return redirect()->route("business.subscription");
        }

        $paystack    = PaystackTransaction::where("reference", $payment->data->reference)->where('processed', 0)->first();
        $cardDetails = $payment->data->authorization;
        if (isset($paystack) && isset($cardDetails)) {

            try {
                DB::beginTransaction();

                $paystack->processed = 1;
                $paystack->status    = $payment->data->status == "success" ? "Successful" : "Failed";
                $paystack->save();

                if ($paystack->trx_type == "paymentmethod") {

                    $defaultMethod = CustomerCards::where("customer_id", Auth::user()->id)->where("default_card", 1)->first();

                    $newCard                     = new CustomerCards;
                    $newCard->customer_id        = Auth::user()->id;
                    $newCard->authorization_code = encrypt($cardDetails->authorization_code);
                    $newCard->last_four_digits   = $cardDetails->last4;
                    $newCard->expiry_month       = $cardDetails->exp_month;
                    $newCard->expiry_year        = $cardDetails->exp_year;
                    $newCard->card_brand         = $cardDetails->brand;
                    $newCard->issuing_bank       = $cardDetails->bank;
                    $newCard->card_holder        = $cardDetails->account_name;
                    $newCard->default_card       = isset($defaultMethod) ? 0 : 1;
                    $newCard->save();

                    DB::commit();

                    toast("Payment Method Added Successfully", 'success');
                    return redirect()->route("business.subscription");

                }

            } catch (\Exception $e) {
                DB::rollback();
                report($e);

                toast("Something Went Wrong", 'error');
                return redirect()->route("business.subscription");
            }

        } else {
            toast("This transaction has already been processed", 'error');
            return redirect()->route("business.subscription");
        }
    }

}
