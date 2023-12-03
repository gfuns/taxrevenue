<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CardTransactions;
use App\Models\CustomerCards;
use App\Models\CustomerSubscription;
use App\Models\SubscriptionPlan;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * subscriptionPlans
     *
     * @return void
     */
    public function subscriptionPlans()
    {
        $subscriptionPlans = SubscriptionPlan::all();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'subscription_plans' => $subscriptionPlans,
            ],
        ], 200);
    }

    /**
     * activeSubscription
     *
     * @return void
     */
    public function activeSubscription()
    {
        $activeSubscription = CustomerSubscription::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("status", "active")->first();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'subscription_details' => [
                    'subscription_id' => $activeSubscription->id,
                    'plan_id' => $activeSubscription->plan->id,
                    'plan' => $activeSubscription->plan->plan,
                    'duration' => $activeSubscription->plan->duration . " Days",
                    'renewal_date' => $activeSubscription->next_due_date,
                    'auto_renew' => (boolean) $activeSubscription->auto_renew,
                    'card_details' => CustomerCards::where("id", $activeSubscription->card_id)->where("customer_id", Auth::user()->id)->first(),
                ],
            ],
        ], 200);
    }

    /**
     * subscribe
     *
     * @param Request request
     *
     * @return void
     */
    public function subscribe(Request $request)
    {
        $validator = $this->validate($request, [
            'plan_id' => 'required',
            'card_id' => 'required',
        ]);

        $plan = SubscriptionPlan::find($request->plan_id);
        if (isset($plan)) {
            $status = $this->chargeCardWithAuthorization($request->card_id, $plan->id);

            if ($status === true) {

                try {
                    DB::beginTransaction();

                    CustomerSubscription::where("customer_id", Auth::user()->id)->update([
                        "status" => "inactive",
                    ]);

                    $subscription = new CustomerSubscription;
                    $subscription->customer_id = Auth::user()->id;
                    $subscription->plan_id = $plan->id;
                    $subscription->card_id = $request->card_id;
                    $subscription->subscription_amount = $plan->billing_amount;
                    $subscription->next_due_date = Carbon::now()->addDays($plan->duration);
                    $subscription->save();

                    DB::commit();

                    return new JsonResponse([
                        'response' => [
                            'status_code' => (int) 200,
                            'status' => "Successful",
                            'data' => [
                                'subscription_details' => [
                                    'subscription_id' => $subscription->id,
                                    'plan_id' => $plan->id,
                                    'plan' => $plan->plan,
                                    'duration' => $plan->duration . " Days",
                                    'renewal_date' => $subscription->next_due_date,
                                    'auto_renew' => (boolean) $subscription->auto_renew,
                                    'card_details' => CustomerCards::where("id", $request->card_id)->where("customer_id", Auth::user()->id)->first(),
                                ],
                            ],
                        ],
                    ], 200);

                } catch (\Exception $e) {
                    DB::rollback();
                    report($e);
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
                        'message' => 'We could not charge your selected card.',
                    ],
                ], 400);
            }
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Plan with the provided plan id does not exist',
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

    public function setAutoRenewal(Request $request)
    {
        $validator = $this->validate($request, [
            'subscription_id' => 'required',
            'auto_renew' => 'required',
        ]);

        $subscription = CustomerSubscription::find($request->subscription_id);
        if (isset($subscription)) {

            $subscription->auto_renew = $request->auto_renew;
            if ($subscription->save()) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        'data' => [
                            'subscription_details' => [
                                'subscription_id' => $subscription->id,
                                'plan_id' => $subscription->plan->id,
                                'plan' => $subscription->plan->plan,
                                'duration' => $subscription->plan->duration . " Days",
                                'renewal_date' => $subscription->next_due_date,
                                'auto_renew' => (boolean) $subscription->auto_renew,
                                'card_details' => CustomerCards::where("id", $subscription->card_id)->where("customer_id", Auth::user()->id)->first(),
                            ],
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
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Customer subscription with the provided subscription id does not exist.',
                ],
            ], 400);
        }
    }
}
