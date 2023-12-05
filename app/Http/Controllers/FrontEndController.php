<?php

namespace App\Http\Controllers;

use App\Models\Artisans;
use App\Models\BlogPost;
use App\Models\Business;
use App\Models\JobListing;
use App\Models\PlatformCategories;

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

    public function artisans()
    {
        $candidates = Artisans::all();
        return view("artisans", compact("candidates"));
    }
}
