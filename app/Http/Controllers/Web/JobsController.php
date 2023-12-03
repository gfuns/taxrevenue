<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\JobAssets;
use App\Models\JobListing;
use App\Models\TempMedia;
use Auth;
use Carbon\Carbon;
use Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * generateTrackingCode
     *
     * @return void
     */
    public function generateTrackingCode()
    {
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "tracking_code" => $this->genTrxId(),
                ],
            ],
        ], 200);
    }

    /**
     * viewJobs
     *
     * @return void
     */
    public function viewJobs()
    {
        $jobs = JobListing::where("customer_id", Auth::user()->id)->get();
        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "job_listing" => $jobs,
                ],
            ],
        ], 200);
    }

    /**
     * viewJobDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function viewJobDetails(Request $request)
    {
        $validator = $this->validate($request, [
            'job_id' => 'required',
        ]);

        $job = JobListing::find($request->job_id);
        if (isset($job)) {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    "data" => [
                        "job_details" => $job,
                    ],
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 400,
                    'status' => "Failed",
                    'message' => 'Job with the provided job id does not exist',
                ],
            ], 400);
        }

    }

    /**
     * uploadProjectAssets
     *
     * @param Request request
     *
     * @return void
     */
    public function uploadProjectAssets(Request $request)
    {
        $validator = $this->validate($request, [
            'tracking_code' => 'required',
            'asset' => 'required',
            'upload_type' => 'required',
        ]);

        $assets = null;
        $assetType = null;
        $assetName = $request->file('asset')->getClientOriginalName();
        $byteSize = $request->file('asset')->getSize();
        $fileSize = $this->formatFileSize($byteSize);
        $fileType = $request->file('asset')->getClientOriginalExtension();
        $extension = $request->file('asset')->getClientOriginalExtension();
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "svg" || $extension == "webp") {
            $assetType = "image";
        } else {
            $assetType = "file";
        }

        if ($request->upload_type == "new") {
            $tempAsset = new JobAssets;
            $tempAsset->tracking_code = $request->tracking_code;
            $tempAsset->job_listing_id = null;
            $tempAsset->asset_type = $assetType;
            $tempAsset->asset_name = $assetName;
            $tempAsset->asset_url = Cloudinary::uploadFile($request->file('asset')->getRealPath())->getSecurePath();
            $tempAsset->file_size = $fileSize;
            $tempAsset->file_type = $fileType;
            $tempAsset->save();

            $assets = JobAssets::where("tracking_code", $request->tracking_code)->get();
        } else {
            $jobAsset = new JobAssets;
            $jobAsset->tracking_code = $request->tracking_code;
            $jobAsset->job_listing_id = JobListing::where("tracking_code", $request->tracking_code)->first()->id;
            $jobAsset->asset_type = $assetType;
            $jobAsset->asset_name = $assetName;
            $jobAsset->asset_url = Cloudinary::uploadFile($request->file('asset')->getRealPath())->getSecurePath();
            $jobAsset->file_size = $fileSize;
            $jobAsset->file_type = $fileType;
            $jobAsset->save();
            $assets = JobAssets::where("tracking_code", $request->tracking_code)->get();
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'files_and_images' => $assets,
                ],
            ],
        ], 200);

        // if ($extension == "pdf" || $extension == "doc" || $extension == "docx" || $extension == "pptx" || $extension == "xlsx") {
        //     $assetType = "file";
        // }
    }

    /**
     * deleteProjectAsset
     *
     * @param Request request
     *
     * @return void
     */
    public function deleteProjectAsset(Request $request)
    {
        $validator = $this->validate($request, [
            'asset_id' => 'required',
        ]);

        $asset = JobAssets::find($request->asset_id);
        if (isset($asset)) {
            if ($asset->delete()) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "message" => 'Asset Deleted Successfully',
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
                    'message' => 'Asset with the provided asset id does not exist',
                ],
            ], 400);
        }
    }

    /**
     * createNewJob
     *
     * @param Request request
     *
     * @return void
     */
    public function createNewJob(Request $request)
    {
        $validator = $this->validate($request, [
            'job_title' => 'required',
            'tags' => 'required',
            'skill_level' => 'required',
            'job_description' => 'required',
            'job_requirements' => 'required',
            'open_positions' => 'required|integer',
            'duration' => 'required',
            'location_type' => 'required',
            'minimum_salary' => 'required|numeric',
            'maximum_salary' => 'required|numeric',
            'salary_rate' => 'required',
            'currency' => 'required',
            'application_commencement' => 'required',
            'application_deadline' => 'required',
            'languages' => 'required',
            'job_categories' => 'required',
            'engagement_type' => 'required',
            'status' => 'required',
            'tracking_code' => 'required',
        ]);

        if ($request->location_type == "on-site" || $request->location_type == "hybrid") {
            $validator = $this->validate($request, [
                'country' => 'required',
                'country_iso' => 'required',
                'state' => 'required',
                'city' => 'required',
                'street' => 'required',

            ]);
        }

        try {

            $tcExist = JobListing::where("tracking_code", $request->tracking_code)->first();

            if (isset($tcExist)) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'Please generate new tracking code. The tracking code provided is already assigned.',
                    ],
                ], 400);
            }

            $business = Business::where("customer_id", Auth::user()->id)->first();
            if (!isset($business)) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 400,
                        'status' => "Failed",
                        'message' => 'No active business found for this account',
                    ],
                ], 400);
            }

            DB::beginTransaction();
            $job = new JobListing;
            $job->customer_id = Auth::user()->id;
            $job->business_id = $business->id;
            $job->job_title = $request->job_title;
            $job->tags = $request->tags;
            $job->skill_level = $request->skill_level;
            $job->job_description = $request->job_description;
            $job->job_requirements = $request->job_requirements;
            $job->open_positions = $request->open_positions;
            $job->duration = $request->duration;
            $job->location_type = $request->location_type;
            $job->country = $request->country;
            $job->state = $request->state;
            $job->city = $request->city;
            $job->street = $request->street;
            $job->minimum_salary = $request->minimum_salary;
            $job->maximum_salary = $request->maximum_salary;
            $job->salary_rate = $request->salary_rate;
            $job->currency = $request->currency;
            $job->application_commencement = Carbon::parse($request->application_commencement);
            $job->application_deadline = Carbon::parse($request->application_deadline);
            $job->languages = $request->languages;
            $job->job_categories = $request->job_categories;
            $job->engagement_type = $request->engagement_type;
            $job->visibility = $request->status == "draft" ? 'draft' : 'open';
            $job->status = $request->status;
            $job->tracking_code = $request->tracking_code;
            $job->save();

            $tempAssets = TempMedia::where("tracking_code", $request->tracking_code)->get();
            foreach ($tempAssets as $ta) {
                $jobAsset = new JobAssets;
                $jobAsset->job_listing_id = $job->id;
                $jobAsset->asset_type = $ta->asset_type;
                $jobAsset->asset_name = $ta->asset_name;
                $jobAsset->asset_url = $ta->asset_url;
                $jobAsset->file_size = $ta->file_size;
                $jobAsset->file_type = $ta->file_type;
                if ($jobAsset->save()) {
                    $ta->delete();
                }
            }

            DB::commit();

            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    "data" => [
                        "job_details" => $job,
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
                    'message' => 'Something went wrong',
                ],
            ], 400);
        }
    }

    /**
     * updateJobDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function updateJobDetails(Request $request)
    {
        $validator = $this->validate($request, [
            'job_id' => 'required',
            'job_title' => 'required',
            'tags' => 'required',
            'skill_level' => 'required',
            'job_description' => 'required',
            'job_requirements' => 'required',
            'open_positions' => 'required|integer',
            'duration' => 'required',
            'location_type' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street' => 'required',
            'minimum_salary' => 'required|numeric',
            'maximum_salary' => 'required|numeric',
            'salary_rate' => 'required',
            'currency' => 'required',
            'application_commencement' => 'required',
            'application_deadline' => 'required',
            'languages' => 'required',
            'job_categories' => 'required',
            'engagement_type' => 'required',
            'status' => 'required',
        ]);

        try {

            DB::beginTransaction();
            $job = JobListing::find($request->job_id);
            $job->job_title = $request->job_title;
            $job->tags = $request->tags;
            $job->skill_level = $request->skill_level;
            $job->job_description = $request->job_description;
            $job->job_requirements = $request->job_requirements;
            $job->open_positions = $request->open_positions;
            $job->duration = $request->duration;
            $job->location_type = $request->location_type;
            $job->country = $request->country;
            $job->state = $request->state;
            $job->city = $request->city;
            $job->street = $request->street;
            $job->minimum_salary = $request->minimum_salary;
            $job->maximum_salary = $request->maximum_salary;
            $job->salary_rate = $request->salary_rate;
            $job->currency = $request->currency;
            $job->application_commencement = Carbon::parse($request->application_commencement);
            $job->application_deadline = Carbon::parse($request->application_deadline);
            $job->languages = $request->languages;
            $job->job_categories = $request->job_categories;
            $job->engagement_type = $request->engagement_type;
            $job->visibility = $request->status == "draft" ? 'draft' : 'open';
            $job->status = $request->status;
            $job->save();

            DB::commit();

            return new JsonResponse([
                'response' => [
                    'status_code' => (int) 200,
                    'status' => "Successful",
                    "data" => [
                        "job_details" => $job,
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
                    'message' => 'Something went wrong',
                ],
            ], 400);
        }
    }

    /**
     * filterJobs
     *
     * @param Request request
     *
     * @return void
     */
    public function filterJobs(Request $request)
    {
        $jobs = null;
        if (isset($request->status)) {
            if ($request->status == "draft") {
                $jobs = JobListing::where("customer_id", Auth::user()->id)->where("status", $request->status)->get();
            } else {
                $jobs = JobListing::where("customer_id", Auth::user()->id)->where("visibility", $request->status)->get();
            }
        } else {
            $jobs = JobListing::where("customer_id", Auth::user()->id)->get();
        }

        return new JsonResponse([
            'response' => [
                'status_code' => (int) 200,
                'status' => "Successful",
                "data" => [
                    "job_listing" => $jobs,
                ],
            ],
        ], 200);
    }

    /**
     * deleteJob
     *
     * @param Request request
     *
     * @return void
     */
    public function deleteJob(Request $request)
    {
        $validator = $this->validate($request, [
            'job_id' => 'required',
        ]);

        $job = JobListing::find($request->job_id);
        if (isset($job)) {

            if ($job->delete()) {
                return new JsonResponse([
                    'response' => [
                        'status_code' => (int) 200,
                        'status' => "Successful",
                        "data" => [
                            "details" => 'Job Deleted Successfully',
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
                    'message' => 'Job with the provided job id does not exist',
                ],
            ], 400);
        }
    }

    public function genTrxId()
    {
        $pin = range(0, 12);
        $set = shuffle($pin);
        $code = "";
        for ($i = 0; $i < 6; $i++) {
            $code = $code . "" . $pin[$i];
        }

        return "ART-JB-" . $code;
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

}
