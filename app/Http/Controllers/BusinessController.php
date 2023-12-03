<?php

namespace App\Http\Controllers;

use App\Models\AreteWalletTransaction;
use App\Models\Business;
use App\Models\CustomerSubscription;
use App\Models\JobListing;
use App\Models\PlatformCategories;
use App\Models\Referral;

class BusinessController extends Controller
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
     * businesses
     *
     * @return void
     */
    public function businesses()
    {
        $selcat = request()->selcat;
        $search = request()->search;
        $categories = PlatformCategories::orderBy("category_name", "asc")->get();

        if (isset(request()->search) && !isset(request()->selcat)) {
            //Only search
            $lastRecord = Business::where("business_name", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $businesses = Business::orderBy("business_name", "asc")->where("business_name", "LIKE", '%' . $search . '%')->paginate(50);
        } else if (!isset(request()->search) && isset(request()->selcat)) {
            //Only selcat
            $lastRecord = Business::where("category_id", $selcat)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $businesses = Business::orderBy("business_name", "asc")->where("category_id", $selcat)->paginate(50);

        } else if (isset(request()->search) && isset(request()->selcat)) {
            //Search and selcat
            $lastRecord = Business::where("business_name", "LIKE", '%' . $search . '%')->where("category_id", $selcat)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $businesses = Business::orderBy("business_name", "asc")->where("business_name", "LIKE", '%' . $search . '%')->where("category_id", $selcat)->paginate(50);

        } else {
            $lastRecord = Business::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $businesses = Business::orderBy("business_name", "asc")->paginate(50);

        }
        return view("businesses", compact("businesses", "categories", "selcat", "search", "lastRecord", "marker"));
    }

    /**
     * businessDetails
     *
     * @param mixed id
     *
     * @return void
     */
    public function businessDetails($id)
    {
        $business = Business::find($id);
        $recentJobs = JobListing::orderBy("id", "desc")->where("customer_id", $business->customer_id)->limit(2)->get();
        $recentReferrals = Referral::orderBy("id", "desc")->where("customer_id", $business->customer_id)->limit(5)->get();
        return view("business_details", compact("business", "recentJobs", "recentReferrals"));
    }

    /**
     * deposits
     *
     * @param mixed id
     *
     * @return void
     */
    public function deposits($id)
    {
        $business = Business::find($id);

        $lastRecord = AreteWalletTransaction::where("customer_id", $business->customer_id)->where("payment_method", "Card")->where("trx_type", "credit")->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $deposits = AreteWalletTransaction::orderBy("id", "desc")->where("customer_id", $business->customer_id)->where("payment_method", "Card")->where("trx_type", "credit")->paginate(50);

        return view("business_deposits", compact("deposits", "lastRecord", "marker", "business"));
    }

    /**
     * withdrawals
     *
     * @param mixed id
     *
     * @return void
     */
    public function withdrawals($id)
    {
        $business = Business::find($id);

        $lastRecord = AreteWalletTransaction::where("payment_method", "Wallet")->where("customer_id", $business->customer_id)->where("trx_type", "debit")->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $withdrawals = AreteWalletTransaction::orderBy("id", "desc")->where("customer_id", $business->customer_id)->where("payment_method", "Wallet")->where("trx_type", "debit")->paginate(50);

        return view("business_withdrawals", compact("withdrawals", "lastRecord", "marker", "business"));

    }

    /**
     * subscriptionHistory
     *
     * @param mixed id
     *
     * @return void
     */
    public function subscriptionHistory($id)
    {
        $business = Business::find($id);
        $lastRecord = CustomerSubscription::where("customer_id", $business->customer_id)->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $subscriptions = CustomerSubscription::orderBy("id", "desc")->where("customer_id", $business->customer_id)->paginate(50);

        return view("business_subscriptions", compact("subscriptions", "lastRecord", "marker", "business"));
    }

    /**
     * referralList
     *
     * @param mixed id
     *
     * @return void
     */
    public function referralList($id)
    {
        $business = Business::find($id);
        $lastRecord = Referral::where("customer_id", $business->customer_id)->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $referrals = Referral::orderBy("id", "desc")->where("customer_id", $business->customer_id)->paginate(50);

        return view("business_referrals", compact("referrals", "lastRecord", "marker", "business"));
    }

    /**
     * jobListing
     *
     * @return void
     */
    public function jobListing($id)
    {
        $business = Business::find($id);
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->status)) {
            //Only search
            $lastRecord = JobListing::where("customer_id", $business->customer->id)->where("job_title", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("customer_id", $business->customer->id)->where("job_title", "LIKE", '%' . $search . '%')->paginate(50);

        } else if (!isset(request()->search) && isset(request()->status)) {
            //Only status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("customer_id", $business->customer->id)->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("customer_id", $business->customer->id)->whereIn("visibility", $fstatus)->paginate(50);

        } else if (isset(request()->search) && isset(request()->status)) {
            //Only search and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("customer_id", $business->customer->id)->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("customer_id", $business->customer->id)->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->paginate(50);

        } else {

            $lastRecord = JobListing::where("customer_id", $business->customer->id)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("customer_id", $business->customer->id)->paginate(50);
        }
        return view("business_jobs", compact("jobs", "lastRecord", "marker", "search", "status", "business"));
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
