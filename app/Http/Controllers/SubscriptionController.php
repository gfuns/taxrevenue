<?php

namespace App\Http\Controllers;

use App\Models\CustomerSubscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
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

    /**
     * subscriptionPlans
     *
     * @return void
     */
    public function subscriptionPlans()
    {
        $search = request()->search;
        if (isset(request()->search)) {
            $plans = SubscriptionPlan::where("plan", $search)->get();
        } else {
            $plans = SubscriptionPlan::all();
        }
        return view("subscription_plans", compact("plans", "search"));
    }

    /**
     * storeSubscriptionPlan
     *
     * @param Request request
     *
     * @return void
     */
    public function storeSubscriptionPlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_name' => 'required',
            'duration' => 'required|numeric',
            'subscription_amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $plan = new SubscriptionPlan;
        $plan->plan = $request->plan_name;
        $plan->duration = $request->duration;
        $plan->billing_amount = $request->subscription_amount;
        if ($plan->save()) {
            toast('Subscription Plan Created Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while creating subscription plan", 'error');
            return back();
        }
    }

    /**
     * updateSubscriptionPlan
     *
     * @param Request request
     *
     * @return void
     */
    public function updateSubscriptionPlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required',
            'plan_name' => 'required',
            'duration' => 'required|numeric',
            'subscription_amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $plan = SubscriptionPlan::find($request->plan_id);
        $plan->plan = $request->plan_name;
        $plan->duration = $request->duration;
        $plan->billing_amount = $request->subscription_amount;
        if ($plan->save()) {
            toast('Subscription Plan Updated Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while updating subscription plan", 'error');
            return back();
        }
    }

    /**
     * customerSubscriptions
     *
     * @return void
     */
    public function customerSubscriptions()
    {
        $plans = SubscriptionPlan::all();
        $selplan = request()->selplan;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->selplan)) {
            //Only Search has a value

            $records = CustomerSubscription::orderBy("id", "desc")->select('customer_subscriptions.id', 'customer_subscriptions.customer_id', 'customer_subscriptions.plan_id', 'customer_subscriptions.card_id', 'customer_subscriptions.subscription_amount', 'customer_subscriptions.created_at', 'customer_subscriptions.next_due_date')
                ->join('customers as c1', 'customer_subscriptions.customer_id', '=', 'c1.id')
                ->where(function ($query) use ($search) {
                    $query->where('c1.first_name', "LIKE", '%' . $search . '%')
                        ->orWhere('c1.last_name', "LIKE", '%' . $search . '%');
                });

            $lastRecord = $records->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $subscriptions = $records->paginate(50);
        } else if (!isset(request()->search) && isset(request()->selplan)) {
            //Only selplan has a value
            $lastRecord = CustomerSubscription::query()->where("plan_id", $selplan)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $subscriptions = CustomerSubscription::query()->where("plan_id", $selplan)->paginate(50);
        } else if (isset(request()->search) && isset(request()->selplan)) {
            //Search and selplan has a value
            $records = CustomerSubscription::orderBy("id", "desc")->select('customer_subscriptions.id', 'customer_subscriptions.customer_id', 'customer_subscriptions.plan_id', 'customer_subscriptions.card_id', 'customer_subscriptions.subscription_amount', 'customer_subscriptions.created_at', 'customer_subscriptions.next_due_date')
                ->join('customers as c1', 'customer_subscriptions.customer_id', '=', 'c1.id')
                ->where(function ($query) use ($selplan, $search) {
                    $query->where('customer_subscriptions.plan_id', $selplan)
                        ->where('c1.first_name', "LIKE", '%' . $search . '%')
                        ->orWhere('c1.last_name', "LIKE", '%' . $search . '%');
                });

            $lastRecord = $records->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $subscriptions = $records->paginate(50);
        } else {

            $lastRecord = CustomerSubscription::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $subscriptions = CustomerSubscription::orderBy("id", "desc")->paginate(50);
        }
        return view("customer_subscriptions", compact("subscriptions", "plans", "selplan", "lastRecord", "marker", "search"));
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
}
