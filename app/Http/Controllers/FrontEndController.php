<?php

namespace App\Http\Controllers;

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
        return view("welcome", compact("categories", "todayJobs", "topRecruiters"));
    }
}
