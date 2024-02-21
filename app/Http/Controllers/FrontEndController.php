<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail as ContactMail;
use App\Models\ArtisanReviews;
use App\Models\Artisans;
use App\Models\BlogPost;
use App\Models\Business;
use App\Models\BusinessReviews;
use App\Models\CustomerContact;
use App\Models\Faq;
use App\Models\JobListing;
use App\Models\PlatformCategories;
use App\Models\Products;
use App\Models\TutorialVideos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Mail;
use Session;

class FrontEndController extends Controller
{
    public function index()
    {
        $categories = PlatformCategories::all();
        $topRecruiters = Business::where("visibility", 1)->limit(8)->get();
        $blogPosts = BlogPost::orderBy("id", "desc")->where("visibility", "public")->where("status", "published")->limit(6)->get();
        return view("welcome", compact("categories", "topRecruiters", "blogPosts"));
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
        $filter = request()->filter == null ? 'asc' : request()->filter;
        $location = request()->location;
        $keyword = request()->keyword;
        if (isset($location) || isset($keyword)) {
            if (isset($location) && !isset($keyword)) {
                $lastRecord = Business::where("state", $location)->count();
                $marker = $this->pageMarkers($lastRecord, request()->page);
                $businesses = Business::orderBy("id", $filter)->where("state", $location)->paginate(16);
            } else if (!isset($location) && isset($keyword)) {
                $lastRecord = Business::where(function ($query) use ($keyword) {
                    $query->where('business_name', 'LIKE', "%" . $keyword . "%")
                        ->orWhere('business_category', 'LIKE', "%" . $keyword . "%")
                        ->orWhere('business_description', 'LIKE', "%" . $keyword . "%");
                })->count();

                $marker = $this->pageMarkers($lastRecord, request()->page);
                $businesses = Business::orderBy("id", $filter)
                    ->where(function ($query) use ($keyword) {
                        $query->where('business_name', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('business_category', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('business_description', 'LIKE', "%" . $keyword . "%");
                    })->paginate(16);
            } else {
                $lastRecord = Business::where("state", $location)
                    ->where(function ($query) use ($keyword) {
                        $query->where('business_name', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('business_category', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('business_description', 'LIKE', "%" . $keyword . "%");
                    })->count();

                $marker = $this->pageMarkers($lastRecord, request()->page);
                $businesses = Business::orderBy("id", $filter)->where("state", $location)
                    ->where(function ($query) use ($keyword) {
                        $query->where('business_name', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('business_category', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('business_description', 'LIKE', "%" . $keyword . "%");
                    })->paginate(16);
            }

        } else {
            $lastRecord = Business::count();
            $marker = $this->pageMarkers($lastRecord, request()->page);
            $businesses = Business::orderBy("id", $filter)->where("visibility", 1)->paginate(16);
        }
        return view("business_listing", compact("businesses", "lastRecord", "marker", "filter", "location", "keyword"));
    }

    public function businessDetails($slug)
    {
        $business = Business::where("slug", $slug)->first();
        $latestJobs = JobListing::where("business_id", $business->id)->limit(4)->get();
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
        $filter = request()->filter == null ? 'asc' : request()->filter;
        $location = request()->location;
        $keyword = request()->keyword;
        if (isset($location) || isset($keyword)) {
            if (isset($location) && !isset($keyword)) {
                $lastRecord = JobListing::where("state", $location)->count();
                $marker = $this->pageMarkers($lastRecord, request()->page);
                $jobs = JobListing::orderBy("id", $filter)->where("state", $location)->paginate(16);
            } else if (!isset($location) && isset($keyword)) {
                $lastRecord = JobListing::where(function ($query) use ($keyword) {
                    $query->where('job_title', 'LIKE', "%" . $keyword . "%")
                        ->orWhere('tags', 'LIKE', "%" . $keyword . "%")
                        ->orWhere('city', 'LIKE', "%" . $keyword . "%");
                })->count();
                $marker = $this->pageMarkers($lastRecord, request()->page);
                $jobs = JobListing::orderBy("id", $filter)
                    ->where(function ($query) use ($keyword) {
                        $query->where('job_title', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('tags', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('city', 'LIKE', "%" . $keyword . "%");
                    })->paginate(16);
            } else {
                $lastRecord = JobListing::where("state", $location)
                    ->where(function ($query) use ($keyword) {
                        $query->where('job_title', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('tags', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('city', 'LIKE', "%" . $keyword . "%");
                    })->count();

                $marker = $this->pageMarkers($lastRecord, request()->page);
                $jobs = JobListing::orderBy("id", $filter)->where("state", $location)
                    ->where(function ($query) use ($keyword) {
                        $query->where('job_title', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('tags', 'LIKE', "%" . $keyword . "%")
                            ->orWhere('city', 'LIKE', "%" . $keyword . "%");
                    })->paginate(16);
            }

        } else {
            $lastRecord = JobListing::count();
            $marker = $this->pageMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", $filter)->paginate(16);
        }

        return view("job_portal", compact("jobs", "location", "keyword", "lastRecord", "marker", "filter"));
    }

    public function jobDetails($slug)
    {
        $job = JobListing::where("slug", $slug)->first();
        $categories = explode(', ', $job->getOriginalCategories());
        $categoryNames = PlatformCategories::whereIn('id', $categories)->pluck('category_name');
        $industry = $categoryNames->implode(' / ');
        $similarJobs = JobListing::where("id", "!=", $job->id)->where(function ($query) use ($categories) {
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

        $search = request()->q;
        $filter = request()->filter == null ? 'asc' : request()->filter;
        if (isset($search)) {
            $lastRecord = Products::where("product_name", "LIKE", "%" . $search . "%")->count();
            $marker = $this->shopMarkers($lastRecord, request()->page);
            $products = Products::orderBy("id", $filter)->where("product_name", "LIKE", "%" . $search . "%")->paginate(12);
        } else {
            $lastRecord = Products::count();
            $marker = $this->shopMarkers($lastRecord, request()->page);
            $products = Products::orderBy("id", $filter)->paginate(12);
        }
        return view("shop", compact("products", "search", "lastRecord", "marker", "filter"));
    }

    /**
     * academy
     *
     * @return void
     */
    public function academy()
    {
        $search = request()->q;
        $filter = request()->filter == null ? 'asc' : request()->filter;
        if (isset($search)) {
            $lastRecord = TutorialVideos::where("video_title", "LIKE", "%" . $search . "%")->count();
            $marker = $this->academyMarkers($lastRecord, request()->page);
            $tutorialVideos = TutorialVideos::orderBy("id", $filter)->where("video_title", "LIKE", "%" . $search . "%")->paginate(9);
        } else {
            $lastRecord = TutorialVideos::count();
            $marker = $this->academyMarkers($lastRecord, request()->page);
            $tutorialVideos = TutorialVideos::orderBy("id", $filter)->paginate(9);
        }
        return view("academy", compact("tutorialVideos", "search", "lastRecord", "marker", "filter"));
    }

    /**
     * blogPosts
     *
     * @return void
     */
    public function blogPosts()
    {
        $search = request()->q;
        $filter = request()->filter == null ? 'asc' : request()->filter;
        if (isset($search)) {
            $lastRecord = BlogPost::where("post_title", "LIKE", "%" . $search . "%")->count();
            $marker = $this->blogMarkers($lastRecord, request()->page);
            $blogPosts = BlogPost::orderBy("id", $filter)->where("post_title", "LIKE", "%" . $search . "%")->paginate(9);
        } else {
            $lastRecord = BlogPost::count();
            $marker = $this->blogMarkers($lastRecord, request()->page);
            $blogPosts = BlogPost::orderBy("id", $filter)->paginate(6);
        }
        return view("blog", compact("blogPosts", "lastRecord", "marker", "filter", "search"));
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

    public function aboutUs()
    {
        return view("about_us");
    }

    public function contactUs()
    {
        return view("contact_us");
    }

    public function processContactForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $contact = new CustomerContact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        if ($contact->save()) {

            try {
                $user = "gfunzy@gmail.com";
                Mail::to($user)->send(new ContactMail($user, $contact));
            } catch (\Exception $e) {
                report($e);
                \Log::info($e->getMessage());
            }

            Session::flash("success", "We have received your message and will get back to you soonest.");
            return back();

            // finally {
            //     Session::flash("success", "We have received your message and will get back to you soonest.");
            //     return back();
            // }

        } else {
            Session::flash("error", "Something Went Wrong");
            return back();
        }
    }

    public function faqs()
    {
        $faqList = Faq::all();
        return view("faqs", compact("faqList"));
    }

    public function forum()
    {
        return Redirect::to("https://preview.wstacks.com/proforum/");
    }

    public function terms()
    {
        return view("terms");
    }

    public function privacyPolicy()
    {
        return view("privacy_policy");
    }

    public function cookiePolicy()
    {
        return view("cookie_policy");
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

    public function shopMarkers($lastRecord, $pageNum)
    {
        if ($pageNum == null) {
            $pageNum = 1;
        }
        $end = (12 * ((int) $pageNum));
        $marker = array();
        if ((int) $pageNum == 1) {
            $marker["begin"] = (int) $pageNum;
            $marker["index"] = (int) $pageNum;
        } else {
            $marker["begin"] = number_format(((12 * ((int) $pageNum)) - 11), 0);
            $marker["index"] = number_format(((12 * ((int) $pageNum)) - 11), 0);
        }

        if ($end > $lastRecord) {
            $marker["end"] = number_format($lastRecord, 0);
        } else {
            $marker["end"] = number_format($end, 0);
        }

        return $marker;
    }

    public function academyMarkers($lastRecord, $pageNum)
    {
        if ($pageNum == null) {
            $pageNum = 1;
        }
        $end = (9 * ((int) $pageNum));
        $marker = array();
        if ((int) $pageNum == 1) {
            $marker["begin"] = (int) $pageNum;
            $marker["index"] = (int) $pageNum;
        } else {
            $marker["begin"] = number_format(((9 * ((int) $pageNum)) - 8), 0);
            $marker["index"] = number_format(((9 * ((int) $pageNum)) - 8), 0);
        }

        if ($end > $lastRecord) {
            $marker["end"] = number_format($lastRecord, 0);
        } else {
            $marker["end"] = number_format($end, 0);
        }

        return $marker;
    }

    public function pageMarkers($lastRecord, $pageNum)
    {
        if ($pageNum == null) {
            $pageNum = 1;
        }
        $end = (16 * ((int) $pageNum));
        $marker = array();
        if ((int) $pageNum == 1) {
            $marker["begin"] = (int) $pageNum;
            $marker["index"] = (int) $pageNum;
        } else {
            $marker["begin"] = number_format(((16 * ((int) $pageNum)) - 15), 0);
            $marker["index"] = number_format(((16 * ((int) $pageNum)) - 15), 0);
        }

        if ($end > $lastRecord) {
            $marker["end"] = number_format($lastRecord, 0);
        } else {
            $marker["end"] = number_format($end, 0);
        }

        return $marker;
    }
}
