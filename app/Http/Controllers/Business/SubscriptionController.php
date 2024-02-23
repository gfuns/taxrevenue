<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\CardTransactions;
use App\Models\CustomerCards;
use App\Models\CustomerSubscription;
use App\Models\SubscriptionPlan;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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
        $customerCards = CustomerCards::where("customer_id", Auth::user()->id)->get();
        return view("business.subscription", compact("activeSubscription", "customerCards"));

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
            if ($card->delete()) {
                toast('Card Details Deleted Successfully.', 'success');
                return back();
            } else {
                toast('Something went wrong.', 'error');
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
        $primaryCard = CustomerCards::where("customer_id", Auth::user()->id)->where("default_card", 1)->first();
        return view("business.initiate_subscription", compact("subscriptionPlans", "primaryCard"));
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
        try {

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
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return false;
        }

    }

    public function setAutoRenewal(Request $request)
    {

        CustomerSubscription::where('customer_id', Auth::user()->id)->where("id", $request->param)->update([
            'auto_renew' => $request->status,
        ]);

        return response()->json(['status' => 200, 'message' => 'Autorenew status updated successfully.']);

    }

}
