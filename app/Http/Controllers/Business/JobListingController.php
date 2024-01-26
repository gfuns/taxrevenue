<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\JobApplication;
use App\Models\JobAssets;
use App\Models\JobListing;
use App\Models\JobMilestone;
use Illuminate\Support\Facades\Validator;
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
     * jobDetails
     *
     * @param mixed id
     *
     * @return void
     */
    public function jobDetails($id)
    {
        $job = JobListing::find($id);
        return view("business.job_details", compact("job"));
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
        return view("business.job_assets", compact("jobAssets", "job"));
    }

    public function allJobApplications()
    {
        $search = null;
        $status = null;
        $business = Business::where("customer_id", Auth::user()->id)->first();
        $jobs = JobListing::where("business_id", $business->id)->pluck("id");
        $lastRecord = JobApplication::whereIn("job_listing_id", $jobs)->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $applications = JobApplication::with("artisan")->with("jobListing")->orderBy("id", "desc")->whereIn("job_listing_id", $jobs)->paginate(50);

        return view("business.all_applications", compact("applications", "lastRecord", "marker", "search", "status"));
    }

    public function jobApplications($jobId)
    {
        $search = null;
        $status = null;
        $lastRecord = JobApplication::where("job_listing_id", $jobId)->count();
        $marker = $this->getMarkers($lastRecord, request()->page);
        $applications = JobApplication::with("artisan")->with("jobListing")->orderBy("id", "desc")->where("job_listing_id", $jobId)->paginate(50);

        return view("business.job_applications", compact("applications", "lastRecord", "marker", "search", "status"));
    }

    public function archiveJobApplications($id)
    {
        $application = JobApplication::find($id);
        if (isset($application)) {
            $application->status = "Archived";
            if ($application->save()) {
                toast("Application Archived Successfully", 'success');
                return back();
            } else {
                toast("Something Went Wrong", 'error');
                return back();
            }
        } else {
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function approveApplication($id)
    {
        $application = JobApplication::find($id);
        if (isset($application)) {
            $application->status = "Approved";
            $application->hiring_status = "Hired";
            $application->completion_status = "In Progress";
            if ($application->save()) {
                toast("Application Approved Successfully", 'success');
                return back();
            } else {
                toast("Something Went Wrong", 'error');
                return back();
            }
        } else {
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function rejectApplication($id)
    {
        $application = JobApplication::find($id);
        if (isset($application)) {
            $application->status = "Rejected";
            $application->hiring_status = "Rejected";
            $application->completion_status = "N/A";
            if ($application->save()) {
                toast("Application Rejected Successfully", 'success');
                return back();
            } else {
                toast("Something Went Wrong", 'error');
                return back();
            }
        } else {
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function applicationDetails($id)
    {
        $application = JobApplication::with("artisan")->with("jobListing")->find($id);
        if (isset($application)) {
            return view("business.application_details", compact("application"));
        } else {
            toast("Something Went Wrong", 'error');
            return back();
        }
    }


    public function addProjectMilestone(Request $request){
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
            'milestone' => 'required',
            'milestone_fee' => 'required|numeric',
            'deadline' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $milestone = new JobMilestone;
        $milestone->job_listing_id = $request->job_id;
        $milestone->milestone = $request->milestone;
        $milestone->currency = "NGN";
        $milestone->milestone_fee = abs(preg_replace("/,/", "", $request->milestone_fee));
        $milestone->deadline = $request->deadline;
        if($milestone->save()){
            toast("Job Milestone Added Successfully", 'success');
            return back();
        }else{
            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function updateProjectMilestone(Request $request){
        $validator = Validator::make($request->all(), [
            'milestone_id' => 'required',
            'milestone' => 'required',
            'milestone_fee' => 'required|numeric',
            'deadline' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $milestone = JobMilestone::find($request->milestone_id);
        $milestone->milestone = $request->milestone;
        $milestone->currency = "NGN";
        $milestone->milestone_fee = abs(preg_replace("/,/", "", $request->milestone_fee));
        $milestone->deadline = $request->deadline;
        if($milestone->save()){
            toast("Milestone Updated Successfully", 'success');
            return back();
        }else{
            toast("Something Went Wrong", 'error');
            return back();
        }
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
