<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessPage;
use App\Models\BusinessReviews;
use App\Models\JobListing;

class MobileViews extends Controller
{
    //

    public function businessDetails($slug)
    {
        $business = Business::where("slug", $slug)->first();
        $latestJobs = JobListing::where("business_id", $business->id)->limit(4)->get();
        $reviews = BusinessReviews::orderBy("rating", "desc")->where("business_id", $business->id)->limit(5)->get();
        $topBanner = BusinessPage::where("business_id", $business->id)->where("file_position", "banner")->first();
        $sliderBanners = BusinessPage::where("business_id", $business->id)->where("file_position", "slider")->get();
        $catalogues = BusinessPage::where("business_id", $business->id)->where("file_position", "catalogue")->get();
        return view("mobile.business_page", compact("business", "latestJobs", "reviews", "topBanner", "sliderBanners", "catalogues"));
    }

    public function index()
    {
        $posts = ForumPosts::orderBy("id", "desc")->limit(20)->get();
        return view("mobile.forum", compact("posts"));
    }
}
