<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\JobListing;
use App\Models\PlatformCategories;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;

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
            $lastRecord = JobListing::where("business_id", $business->id)->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("business_id", $business->id)->where("status", $status)->paginate(50);

        } else if (isset(request()->search) && isset(request()->status)) {
            //Only search and status
            $lastRecord = JobListing::where("business_id", $business->id)->where("job_title", "LIKE", '%' . $search . '%')->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("business_id", $business->id)->where("job_title", "LIKE", '%' . $search . '%')->where("status", $status)->paginate(50);

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

    public function initializeNewJob()
    {
        Session::forget("JTC");
        $trackingCode = $this->genTrackingCode();
        Session::put("JTC", $trackingCode);

        return redirect()->route("business.newJobListing");
    }

    public function newJobListing()
    {
        $jobCategories = PlatformCategories::orderBy("category_name", "asc")->where("category_type", "job")->get();
        return view("business.new_job_listing", compact("jobCategories"));
    }

    public function storeJobListing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_title' => 'required',
            'tags' => 'required',
            'company_description' => 'required',
            'job_description' => 'required',
            'work_location' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'office_address' => 'required',
            'minimum_renumeration' => 'required|numeric',
            'maximum_renumeration' => 'required|numeric',
            'payment_schedule' => 'required',
            'categories' => 'required',
            'engagement_type' => 'required',
            'job_status' => 'required',
            'application_url' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $business = Business::where("customer_id", Auth::user()->id)->first();
            if (!isset($business)) {
                toast("No active business found for this account", 'error');
                return back();
            }

            $tagsArray = json_decode($request->tags, true);
            $tags = implode(', ', array_column($tagsArray, 'value'));
            $jobCategories = implode(', ', $request->input('categories', []));

            DB::beginTransaction();
            $job = new JobListing;
            $job->customer_id = Auth::user()->id;
            $job->business_id = $business->id;
            $job->job_title = $request->job_title;
            $job->slug = preg_replace("/ /", "-", strtolower($request->job_title)) . "-" . strtotime(now());
            $job->tags = $tags;
            $job->company_description = $request->company_description;
            $job->job_description = $request->job_description;
            $job->location = $request->work_location;
            $job->country = $request->country;
            $job->state = $request->state;
            $job->city = $request->city;
            $job->office_address = $request->office_address;
            $job->minimum_salary = $request->minimum_renumeration;
            $job->maximum_salary = $request->maximum_renumeration;
            $job->salary_rate = $request->payment_schedule;
            $job->currency = "NGN";
            $job->job_categories = $jobCategories;
            $job->engagement_type = $request->engagement_type;
            $job->application_url = $request->application_url;
            $job->status = $request->job_status;
            $job->save();

            DB::commit();

            toast("Job Created Successfully", 'success');
            return redirect()->route("business.jobListing");

        } catch (\Exception $e) {
            DB::rollback();
            report($e);

            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function editJobDetails($id)
    {
        $jobDetails = JobListing::find($id);
        $jobCategories = PlatformCategories::all();
        return view("business.update_job", compact("jobDetails", "jobCategories"));
    }

    public function updateJobListing(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
            'job_title' => 'required',
            'tags' => 'required',
            'company_description' => 'required',
            'job_description' => 'required',
            'work_location' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'office_address' => 'required',
            'minimum_renumeration' => 'required|numeric',
            'maximum_renumeration' => 'required|numeric',
            'payment_schedule' => 'required',
            'categories' => 'required',
            'engagement_type' => 'required',
            'job_status' => 'required',
            'application_url' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $business = Business::where("customer_id", Auth::user()->id)->first();
            if (!isset($business)) {
                toast("No active business found for this account", 'error');
                return back();
            }

            $tagsArray = json_decode($request->tags, true);
            $tags = implode(', ', array_column($tagsArray, 'value'));
            $jobCategories = implode(', ', $request->input('categories', []));

            DB::beginTransaction();
            $job = JobListing::find($request->job_id);
            $job->job_title = $request->job_title;
            $job->slug = preg_replace("/ /", "-", strtolower($request->job_title)) . "-" . strtotime(now());
            $job->tags = $tags;
            $job->company_description = $request->company_description;
            $job->job_description = $request->job_description;
            $job->location = $request->work_location;
            $job->country = $request->country;
            $job->state = $request->state;
            $job->city = $request->city;
            $job->office_address = $request->office_address;
            $job->minimum_salary = $request->minimum_renumeration;
            $job->maximum_salary = $request->maximum_renumeration;
            $job->salary_rate = $request->payment_schedule;
            $job->currency = "NGN";
            $job->job_categories = $jobCategories;
            $job->engagement_type = $request->engagement_type;
            $job->application_url = $request->application_url;
            $job->status = $request->job_status;
            $job->save();

            DB::commit();

            toast("Job Details Updated Successfully", 'success');
            return back();

        } catch (\Exception $e) {
            DB::rollback();
            report($e);

            toast("Something Went Wrong", 'error');
            return back();
        }
    }

    public function deleteJob($id)
    {
        $job = JobListing::find($id);
        if (isset($job)) {
            if ($job->delete()) {
                toast("Job Deleted Successfully", 'success');
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

    public function archiveJob($id)
    {
        $job = JobListing::find($id);
        if (isset($job)) {
            $job->status = "archived";
            if ($job->save()) {
                toast("Job Archived Successfully", 'success');
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

    public function publishJob($id)
    {
        $job = JobListing::find($id);
        if (isset($job)) {
            $job->status = "published";
            if ($job->save()) {
                toast("Job Published Successfully", 'success');
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

    public function formatFileSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;

        while ($size > 1024) {
            $size /= 1024;
            $i++;
        }

        return round($size, 2) . ' ' . $units[$i];
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

    public function genTrackingCode()
    {
        $pin = range(0, 12);
        $set = shuffle($pin);
        $code = "";
        for ($i = 0; $i < 6; $i++) {
            $code = $code . "" . $pin[$i];
        }

        return "ART-JB-" . $code;
    }
}
