<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\JobAssets;
use App\Models\JobListing;

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

    /**
     * allJobs
     *
     * @return void
     */
    public function allJobs()
    {
        $author = request()->author;
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->author) && !isset(request()->status)) {
            //Only search
            $lastRecord = JobListing::where("job_title", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("job_title", "LIKE", '%' . $search . '%')->paginate(50);

        } else if (!isset(request()->search) && isset(request()->author) && !isset(request()->status)) {
            //Only author
            $lastRecord = JobListing::where("author", $author)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", $author)->paginate(50);

        } else if (!isset(request()->search) && !isset(request()->author) && isset(request()->status)) {
            //Only status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->whereIn("visibility", $fstatus)->paginate(50);

        } else if (isset(request()->search) && isset(request()->author) && !isset(request()->status)) {
            //Only search and author
            $lastRecord = JobListing::where("job_title", "LIKE", '%' . $search . '%')->where("author", $author)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("job_title", "LIKE", '%' . $search . '%')->where("author", $author)->paginate(50);

        } else if (isset(request()->search) && !isset(request()->author) && isset(request()->status)) {
            //Only search and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->author) && isset(request()->status)) {
            //Only author and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("author", $author)->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", $author)->whereIn("visibility", $fstatus)->paginate(50);

        } else if (isset(request()->search) && isset(request()->author) && isset(request()->status)) {
            //Search, author and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("job_title", "LIKE", '%' . $search . '%')->where("author", $author)->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("job_title", "LIKE", '%' . $search . '%')->where("author", $author)->whereIn("visibility", $fstatus)->paginate(50);
        } else {

            $lastRecord = JobListing::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->paginate(50);
        }
        return view("all_jobs", compact("jobs", "lastRecord", "marker", "search", "status", "author"));
    }

    /**
     * customerJobs
     *
     * @return void
     */
    public function customerJobs()
    {
        $author = request()->author;
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->author) && !isset(request()->status)) {
            //Only search
            $lastRecord = JobListing::where("author", "Business")->where("job_title", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "Business")->where("job_title", "LIKE", '%' . $search . '%')->paginate(50);

        } else if (!isset(request()->search) && isset(request()->author) && !isset(request()->status)) {
            //Only author
            $lastRecord = JobListing::where("author", "Business")->where("customer_id", $author)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "Business")->where("customer_id", $author)->paginate(50);

        } else if (!isset(request()->search) && !isset(request()->author) && isset(request()->status)) {
            //Only status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("author", "Business")->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "Business")->whereIn("visibility", $fstatus)->paginate(50);

        } else if (isset(request()->search) && isset(request()->author) && !isset(request()->status)) {
            //Only search and author
            $lastRecord = JobListing::where("author", "Business")->where("job_title", "LIKE", '%' . $search . '%')->where("customer_id", $author)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "Business")->where("job_title", "LIKE", '%' . $search . '%')->where("customer_id", $author)->paginate(50);

        } else if (isset(request()->search) && !isset(request()->author) && isset(request()->status)) {
            //Only search and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("author", "Business")->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "Business")->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->author) && isset(request()->status)) {
            //Only author and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("author", "Business")->where("customer_id", $author)->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "Business")->where("customer_id", $author)->whereIn("visibility", $fstatus)->paginate(50);

        } else if (isset(request()->search) && isset(request()->author) && isset(request()->status)) {
            //Search, author and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("author", "Business")->where("job_title", "LIKE", '%' . $search . '%')->where("customer_id", $author)->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "Business")->where("job_title", "LIKE", '%' . $search . '%')->where("customer_id", $author)->whereIn("visibility", $fstatus)->paginate(50);
        } else {

            $lastRecord = JobListing::where("author", "Business")->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "Business")->paginate(50);
        }
        $businesses = Business::orderBy("business_name", "asc")->get();
        return view("customer_jobs", compact("jobs", "lastRecord", "marker", "search", "status", "author", "businesses"));
    }

    /**
     * inHouseJobs
     *
     * @return void
     */
    public function inHouseJobs()
    {
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->status)) {
            //Only search
            $lastRecord = JobListing::where("author", "In-House")->where("job_title", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "In-House")->where("job_title", "LIKE", '%' . $search . '%')->paginate(50);

        } else if (!isset(request()->search) && isset(request()->status)) {
            //Only status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("author", "In-House")->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "In-House")->whereIn("visibility", $fstatus)->paginate(50);

        } else if (isset(request()->search) && isset(request()->status)) {
            //Only search and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("author", "In-House")->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "In-House")->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->paginate(50);

        } else {

            $lastRecord = JobListing::where("author", "In-House")->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("author", "In-House")->paginate(50);
        }
        return view("in_house_jobs", compact("jobs", "lastRecord", "marker", "search", "status"));
    }

    /**
     * jobDetails
     *
     * @param mixed id
     *
     * @return void
     */
    public function jobDetails($id)
    {
        $job = JobListing::find($id);
        return view("job_details", compact("job"));
    }

    /**
     * jobAssets
     *
     * @param mixed id
     *
     * @return void
     */
    public function jobAssets($id)
    {
        $job = JobListing::find($id);
        $jobAssets = JobAssets::where("job_listing_id", $id)->get();
        return view("job_assets", compact("jobAssets", "job"));
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
