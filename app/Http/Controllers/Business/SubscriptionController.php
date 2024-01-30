<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\CardTransactions;
use App\Models\CustomerCards;
use App\Models\CustomerSubscription;
use App\Models\SubscriptionPlan;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

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
        if (isset($activeSubscription)) {
            return view("business.subscription", compact("activeSubscription"));
        } else {
            return redirect()->route("business.subscribe");
        }
    }

    public function initiateSubscription()
    {
        $subscriptionPlans = SubscriptionPlan::where("id", ">", 1)->get();
        return view("business.initiate_subscription", compact("subscriptionPlans"));
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

    public function processSubscription($planId, $cardId)
    {
        $plan = SubscriptionPlan::find($planId);
        $card = CustomerCards::find($cardId);
        if (isset($plan) && isset($card)) {
            $status = $this->chargeCardWithAuthorization($cardId, $planId);

            if ($status === true) {
                try {
                    DB::beginTransaction();

                    CustomerSubscription::where("customer_id", Auth::user()->id)->update([
                        "status" => "inactive",
                    ]);

                    $subscription = new CustomerSubscription;
                    $subscription->customer_id = Auth::user()->id;
                    $subscription->plan_id = $plan->id;
                    $subscription->card_id = $card->id;
                    $subscription->subscription_amount = $plan->billing_amount;
                    $subscription->auto_renew = 1;
                    $subscription->status = "active";
                    $subscription->next_due_date = Carbon::now()->addDays($plan->duration);
                    $subscription->save();

                    DB::commit();

                    toast('Subscription Successful.', 'success');
                    return redirect()->route("business.subscription");

                } catch (\Exception $e) {
                    DB::rollback();
                    report($e);

                    toast('Something went wrong.', 'error');
                    return back();
                }
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
        $plan = SubscriptionPlan::find($planId);
        $card = CustomerCards::where("id", $cardId)->where("customer_id", Auth::user()->id)->first();
        if (isset($plan) && isset($card)) {
            $response = Http::accept('application/json')->withHeaders([
                'Authorization' => "Bearer " . env('PAYSTACK_SECRET_KEY'),
            ])->post("https://api.paystack.co/transaction/charge_authorization", [
                "authorization_code" => $card->authorization_code,
                "email" => Auth::user()->email,
                "amount" => ($plan->billing_amount * 100),
            ]);

            $resData = $response->json();

            if ($resData["status"] === true && $resData["data"]["status"] == "success") {
                $cardTrx = new CardTransactions;
                $cardTrx->customer_id = Auth::user()->id;
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

    }

}
