<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\JobListing;
use Auth;
use Illuminate\Http\Request;

class JobListingController extends Controller
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

    public function jobListings(Request $request)
    {
        $business = Business::where("customer_id", Auth::user()->id)->first();

        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->status)) {
            //Only search
            $lastRecord = JobListing::where("business_id", $business->id)->where("job_title", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("business_id", $business->id)->where("job_title", "LIKE", '%' . $search . '%')->paginate(50);

        } else if (!isset(request()->search) && isset(request()->status)) {
            //Only status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("business_id", $business->id)->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("business_id", $business->id)->whereIn("visibility", $fstatus)->paginate(50);

        } else if (isset(request()->search) && isset(request()->status)) {
            //Only search and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("business_id", $business->id)->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("business_id", $business->id)->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->paginate(50);

        } else {

            $lastRecord = JobListing::where("business_id", $business->id)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("business_id", $business->id)->paginate(50);
        }
        return view("business.jobs", compact("jobs", "lastRecord", "marker", "search", "status"));
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
