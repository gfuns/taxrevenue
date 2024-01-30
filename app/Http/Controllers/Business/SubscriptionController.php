<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\CustomerCards;
use App\Models\CustomerSubscription;
use App\Models\SubscriptionPlan;
use Auth;
use Illuminate\Support\Facades\DB;
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
        $subscriptionPlans = SubscriptionPlan::where("id", ">", 1)->get();
        return view("business.subscriptions", compact("subscriptionPlans"));
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
            'auto_renew' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $plan = SubscriptionPlan::find($plan_id);
        if (isset($plan)) {
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
                $subscription->auto_renew = $request->auto_renew;
                $subscription->status = "active";
                $subscription->save();

                DB::commit();

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
    }
}
