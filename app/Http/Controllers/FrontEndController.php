<?php

namespace App\Http\Controllers;

use App\Models\Artisans;
use App\Models\BlogPost;
use App\Models\Business;
use App\Models\JobListing;
use App\Models\PlatformCategories;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $categories = PlatformCategories::all();
        $todayJobs = JobListing::orderBy("id", "desc")->where("visibility", "open")->limit(8)->get();
        $topRecruiters = Business::where("visibility", 1)->limit(20)->get();
        $blogPosts = BlogPost::orderBy("id", "desc")->where("visibility", "public")->where("status", "published")->limit(6)->get();
        return view("welcome", compact("categories", "todayJobs", "topRecruiters", "blogPosts"));
    }

    public function findJobs()
    {
        $categories = PlatformCategories::all();
        $jobs = JobListing::where("visibility", "open")->get();
        return view("find_jobs", compact("categories", "jobs"));
    }

    public function jobsByCategory($slug)
    {
        $category = PlatformCategories::where("slug", $slug)->first();
        $jobs = JobListing::where("job_categories", $category->id)->where("visibility", "open")->get();
        return view("category_jobs", compact("category", "jobs"));
    }

    public function jobsCategories()
    {
        $categories = PlatformCategories::all();
        return view("job_categories", compact("categories"));
    }

    public function artisans(Request $request)
    {
        if (isset($request->filter)) {

            $records = Artisans::with(['customer']);

            /**
             * Searching the names key inside
             * the user relationship
             */
            $records->whereNotNull("biography")->whereNotNull("profession")->where(fn($query) =>
                $query->whereHas('customer', fn($query2) =>
                    $query2->where('first_name', 'LIKE', $request->filter . '%')->orWhere('last_name', 'LIKE', $request->filter . '%'))
            );

            /**
             * Returning the response
             */

            $candidates = collect($records->get());

        } else {

            $candidates = Artisans::whereNotNull("biography")->whereNotNull("profession")->get();
        }
        return view("artisans", compact("candidates"));
    }
}
