<?php

namespace App\Http\Controllers;

use App\Models\CardTransactions;
use App\Models\Customer;
use App\Models\CustomerCards;
use App\Models\CustomerSubscription;
use App\Models\CustomerWallet;
use App\Models\Referral;
use App\Models\ReferralTransaction;
use App\Models\SubscriptionPlan;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CronController extends Controller
{
    //

    public function renewSubscription()
    {
        $today = Carbon::today()->toDateString();
        $renewableTransactions = CustomerSubscription::whereDate("next_due_date", $today)->where("status", "active")->get();
        foreach ($renewableTransactions as $rt) {

            $activeCard = CustomerCards::where("customer_id", $rt->customer_id)->where("default_card", 1)->first();
            $plan = SubscriptionPlan::find($rt->plan_id);

            $status = $this->chargeCardWithAuthorization($activeCard->id, $rt->plan_id, $rt->customer_id);

            if ($status === true) {
                try {
                    DB::beginTransaction();

                    CustomerSubscription::where("customer_id", $rt->customer_id)->update([
                        "status" => "inactive",
                    ]);

                    $subscription = new CustomerSubscription;
                    $subscription->customer_id = $rt->customer_id;
                    $subscription->plan_id = $plan->id;
                    $subscription->card_details = ucwords($activeCard->card_brand) . " ending with " . $activeCard->last_four_digits;
                    $subscription->subscription_amount = $plan->billing_amount;
                    $subscription->auto_renew = 1;
                    $subscription->status = "active";
                    $subscription->next_due_date = Carbon::now()->addDays($plan->duration);
                    $subscription->save();

                    $referral = Referral::where("referral_id", $rt->customer_id)->first();
                    if (isset($referral)) {
                        $bonus = ((5 / 100) * $plan->billing_amount);
                        $customer = Customer::find($referral->customer_id);

                        $transaction = new ReferralTransaction;
                        $transaction->customer_id = $referral->customer_id;
                        $transaction->trx_type = "credit";
                        $transaction->amount = $bonus;
                        $transaction->details = "Bonus received from subcription made by " . $referral->customer->first_name . " " . $referral->customer->last_name;
                        $transaction->balance_before = $customer->wallet->referral_points;
                        $transaction->balance_after = ($customer->wallet->referral_points + $bonus);
                        $transaction->save();

                        $customerWallet = CustomerWallet::where("customer_id", $referral->customer_id)->first();
                        $customerWallet->referral_points = (double) ($customerWallet->referral_points + $bonus);
                        $customerWallet->save();
                    }
                    DB::commit();

                } catch (\Exception $e) {
                    DB::rollback();
                    report($e);

                }
            } else {
                $rt->status = "inactive";
                $rt->save();
            }
        }

    }

    /**
     * chargeCardWithAuthorization
     *
     * @param mixed cardId
     *
     * @return void
     */
    public function chargeCardWithAuthorization($cardId, $planId, $customerId)
    {
        try {
            $customer = Customer::find($customerId);
            $plan = SubscriptionPlan::find($planId);
            $card = CustomerCards::where("id", $cardId)->where("customer_id", $customer->id)->first();
            if (isset($plan) && isset($card)) {
                $response = Http::accept('application/json')->withHeaders([
                    'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
                ])->post("https://api.paystack.co/transaction/charge_authorization", [
                    "authorization_code" => $card->authorization_code,
                    "email" => $customer->email,
                    "amount" => ($plan->billing_amount * 100),
                ]);

                $resData = $response->json();

                if ($resData["status"] === true && $resData["data"]["status"] == "success") {
                    $cardTrx = new CardTransactions;
                    $cardTrx->customer_id = $customer->id;
                    $cardTrx->card_id = $cardId;
                    $cardTrx->amount = $plan->billing_amount;
                    $cardTrx->paystack_reference = $resData["data"]["reference"];
                    $cardTrx->description = ucwords($card->card_brand) . " card:  " . $card->last_four_digits . " - Customer Subscription to " . $plan->plan . " Plan (" . $plan->duration . ")";
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
            return false;
        }

    }
}
