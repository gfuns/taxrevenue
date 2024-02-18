<?php

namespace App\Http\Controllers;

use App\Models\ArtisanReviews;
use App\Models\Artisans;
use App\Models\BlogPost;
use App\Models\Business;
use App\Models\BusinessReviews;
use App\Models\JobListing;
use App\Models\PlatformCategories;
use App\Models\Products;
use App\Models\TutorialVideos;
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

    /**
     * businessListing
     *
     * @param Request request
     *
     * @return void
     */
    public function businessListing(Request $request)
    {
        if (isset($request->filter)) {

            $businesses = Business::where("visibility", 1)->where("business_name", 'LIKE', $request->filter . '%')->get();

        } else {
            $businesses = Business::where("visibility", 1)->get();
        }
        return view("business_listing", compact("businesses"));
    }

    public function businessDetails($slug)
    {
        $business = Business::where("slug", $slug)->first();
        $latestJobs = JobListing::where("business_id", $business->id)->where("visibility", "open")->limit(4)->get();
        $reviews = BusinessReviews::orderBy("rating", "desc")->limit(5)->get();
        return view("business_details", compact("business", "latestJobs", "reviews"));
    }

    /**
     * jobPortal
     *
     * @return void
     */
    public function jobPortal()
    {
        $categories = PlatformCategories::all();
        $jobs = JobListing::where("visibility", "open")->get();
        return view("job_portal", compact("categories", "jobs"));
    }

    public function jobDetails($slug)
    {
        $job = JobListing::where("slug", $slug)->first();
        $categories = explode(', ', $job->getOriginalCategories());
        $categoryNames = PlatformCategories::whereIn('id', $categories)->pluck('category_name');
        $industry = $categoryNames->implode(' / ');
        $similarJobs = JobListing::where("id", "!=", $job->id)->where("visibility", "open")->where(function ($query) use ($categories) {
            foreach ($categories as $categoryId) {
                $query->orWhereRaw("FIND_IN_SET(?, job_categories)", [$categoryId]);
            }
        })->limit(5)->get();
        return view("job_details", compact("job", "similarJobs", "industry"));
    }

    /**
     * shop
     *
     * @return void
     */
    public function shop()
    {
        $products = Products::orderBy("product_name", "asc")->get();
        return view("shop", compact("products"));
    }

    /**
     * academy
     *
     * @return void
     */
    public function academy()
    {
        $tutorialVideos = TutorialVideos::all();
        return view("academy", compact("tutorialVideos"));
    }

    /**
     * blogPosts
     *
     * @return void
     */
    public function blogPosts()
    {
        $lastRecord = BlogPost::count();
        $marker = $this->blogMarkers($lastRecord, request()->page);
        $blogPosts = BlogPost::orderBy("id", "desc")->paginate(6);
        return view("blog", compact("blogPosts", "lastRecord", "marker"));
    }

    /**
     * blogDetails
     *
     * @param mixed slug
     *
     * @return void
     */
    public function blogDetails($slug)
    {
        $blogPost = BlogPost::where("slug", $slug)->first();
        return view("blog_details", compact("blogPost"));
    }

    public function jobsByCategory($slug)
    {
        $category = PlatformCategories::where("slug", $slug)->first();
        $jobs = JobListing::where("job_categories", "LIKE", "%" . $category->id . "%")->where("visibility", "open")->get();
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
            $records->where("visibility", 1)->where(fn($query) =>
                $query->whereHas('customer', fn($query2) =>
                    $query2->where('first_name', 'LIKE', $request->filter . '%')->orWhere('last_name', 'LIKE', $request->filter . '%'))
            );

            /**
             * Returning the response
             */

            $candidates = collect($records->get());

        } else {

            $candidates = Artisans::where("visibility", 1)->get();
        }
        return view("artisans", compact("candidates"));
    }

    public function artisanDetails($slug)
    {
        $artisan = Artisans::where("slug", $slug)->first();
        $reviews = ArtisanReviews::orderBy("rating", "desc")->limit(5)->get();
        return view("artisan_details", compact("artisan", "reviews"));
    }

    /**
     * blogMarkers Helper Function
     *
     * @param mixed lastRecord
     * @param mixed pageNum
     *
     * @return void
     */
    public function blogMarkers($lastRecord, $pageNum)
    {
        if ($pageNum == null) {
            $pageNum = 1;
        }
        $end = (6 * ((int) $pageNum));
        $marker = array();
        if ((int) $pageNum == 1) {
            $marker["begin"] = (int) $pageNum;
            $marker["index"] = (int) $pageNum;
        } else {
            $marker["begin"] = number_format(((6 * ((int) $pageNum)) - 5), 0);
            $marker["index"] = number_format(((6 * ((int) $pageNum)) - 5), 0);
        }

        if ($end > $lastRecord) {
            $marker["end"] = number_format($lastRecord, 0);
        } else {
            $marker["end"] = number_format($end, 0);
        }

        return $marker;
    }
}
