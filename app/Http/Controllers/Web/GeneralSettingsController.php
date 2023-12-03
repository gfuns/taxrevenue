<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ArtisanReviews;
use App\Models\Artisans;
use App\Models\BlogPost;
use App\Models\Business;
use App\Models\BusinessReviews;
use App\Models\GeneralSettings;
use App\Models\JobListing;
use App\Models\PlatformCategories;
use App\Models\Products;
use App\Models\Testimonial;
use App\Models\TutorialVideos;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * Get Application Key
     *
     *
     * @return JsonResponse
     */
    public function getApplicationKey()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "application_key" => GeneralSettings::appWeb()->setting_value,
            ],
        ], 200);
    }

    /**
     * Get Platform Information
     *
     *
     * @return JsonResponse
     */
    public function platformInfomation()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'contact_details' => [
                    'email' => GeneralSettings::where("setting", "contact_email")->first()->setting_value,
                    'phone' => GeneralSettings::where("setting", "contact_phone")->first()->setting_value,
                    'address' => GeneralSettings::where("setting", "contact_address")->first()->setting_value,
                ],
                'social_handles' => [
                    'facebook' => GeneralSettings::where("setting", "facebook")->first()->setting_value,
                    'twitter' => GeneralSettings::where("setting", "twitter")->first()->setting_value,
                    'instagram' => GeneralSettings::where("setting", "instagram")->first()->setting_value,
                    'youtube' => GeneralSettings::where("setting", "youtube")->first()->setting_value,
                ],
                'statistics' => [
                    'job_vacancies' => 50000,
                    'businesses' => 20000,
                    'artisans' => 60000,
                    'completed_projects' => 50,
                ],
            ],
        ], 200);
    }

    /**
     * platformCategories
     *
     * @return void
     */
    public function platformCategories()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "categories" => PlatformCategories::all(),
            ],
        ], 200);
    }

    /**
     * tutorialVideos
     *
     * @return void
     */
    public function tutorialVideos()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "videos" => TutorialVideos::all(),
            ],
        ], 200);
    }

    /**
     * searchTutorialVideos
     *
     * @param Request request
     *
     * @return void
     */
    public function searchTutorialVideos(Request $request)
    {
        $validator = $this->validate($request, [
            'keyword' => 'required',
        ]);

        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'keyword' => $request->keyword,
                'tutorials' => TutorialVideos::where("video_title", "LIKE", '%' . $request->keyword . '%')->get(),
            ],
        ], 200);
    }

    /**
     * affiliateProducts
     *
     * @return void
     */

    public function affiliateProducts()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "products" => Products::all(),
            ],
        ], 200);
    }

    /**
     * searchAffiliateProducts
     *
     * @param Request request
     *
     * @return void
     */
    public function searchAffiliateProducts(Request $request)
    {
        $validator = $this->validate($request, [
            'keyword' => 'required',
        ]);

        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'keyword' => $request->keyword,
                'products' => Products::where("product_name", "LIKE", '%' . $request->keyword . '%')->get(),
            ],
        ], 200);
    }

    /**
     * businessList
     *
     * @return void
     */
    public function businessList()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "businesses" => Business::orderBy("business_name", "asc")->select('id', 'business_logo', 'business_name', 'business_description', 'country', 'rating')->where("visibility", 1)->get(),
            ],
        ], 200);
    }

    /**
     * topRecruiters
     *
     * @return void
     */
    public function topRecruiters()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "recruiters" => Business::orderBy("rating", "desc")->select('id', 'business_logo', 'business_name', 'business_description', 'country', 'rating')->where("visibility", 1)->limit(9)->get(),
            ],
        ], 200);
    }

    /**
     * businessDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function businessDetails(Request $request)
    {
        $validator = $this->validate($request, [
            'business_id' => 'required',
        ]);

        $business = Business::find($request->business_id);
        if (isset($business)) {
            $jobs = JobListing::select('id', 'job_title', 'customer_id', 'job_description', 'country', 'currency', 'minimum_salary', 'maximum_salary', 'created_at')->where("customer_id", $business->customer_id)->where("visibility", "open")->get();

            return new JsonResponse([
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'business' => $business,
                    'posted_jobs' => $jobs->makeHidden(["featured_images", "featured_files", "customer"]),
                    'reviews' => BusinessReviews::where("business_id", $request->business_id)->get(),
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'status_code' => (int) 400,
                'status' => "Failed",
                'message' => "Business with the provided business id does not exist",
            ], 400);
        }
    }

    /**
     * jobListings
     *
     * @return void
     */
    public function jobListings()
    {
        $jobListing = JobListing::select('id', 'customer_id', 'job_title', 'job_description', 'country', 'engagement_type', 'currency', 'minimum_salary', 'maximum_salary', 'created_at')->where("visibility", 1)->get();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "jobs" => $jobListing->makeHidden(["customer_id", "customer", "featured_images", "featured_files"]),
            ],
        ], 200);
    }

    /**
     * todayJobs
     *
     * @return void
     */
    public function todayJobs()
    {
        $jobListing = JobListing::orderBy("created_at", "desc")->select('id', 'customer_id', 'job_title', 'open_positions', 'job_description', 'country', 'engagement_type', 'currency', 'minimum_salary', 'maximum_salary', 'created_at')->where("visibility", 1)->limit(9)->get();
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "jobs" => $jobListing->makeHidden(["customer_id", "customer", "featured_images", "featured_files"]),
            ],
        ], 200);
    }

    /**
     * jobDetails
     *
     * @return void
     */
    public function jobDetails(Request $request)
    {
        $validator = $this->validate($request, [
            'job_id' => 'required',
        ]);

        $job = JobListing::find($request->job_id);
        if (isset($job)) {
            return new JsonResponse([
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    "job_details" => $job->makeHidden(["customer_id", "customer"]),
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'status_code' => (int) 400,
                'status' => "Failed",
                'message' => "Job with the provided job id does not exist",
            ], 400);
        }
    }

    /**
     * recentBlogPosts
     *
     * @return void
     */
    public function recentBlogPosts()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "blog_posts" => BlogPost::orderBy("id", "desc")->where("status", "published")->where("visibility", "public")->limit(6)->get(),
            ],
        ], 200);
    }

    /**
     * blogPosts
     *
     * @return void
     */
    public function blogPosts()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "blog_posts" => BlogPost::orderBy("id", "desc")->where("status", "published")->where("visibility", "public")->get(),
            ],
        ], 200);
    }

    /**
     * blogPostDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function blogPostDetails(Request $request)
    {
        $validator = $this->validate($request, [
            'slug' => 'required',
        ]);

        $blogPost = BlogPost::where("slug", $request->slug)->first();
        if (isset($blogPost)) {
            return new JsonResponse([
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    "blog_post_details" => $blogPost,
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'status_code' => (int) 400,
                'status' => "Failed",
                'message' => "Blog with the provided slug does not exist",
            ], 400);
        }

    }

    /**
     * searchBlogPosts
     *
     * @param Request request
     *
     * @return void
     */
    public function searchBlogPosts(Request $request)
    {
        $validator = $this->validate($request, [
            'keyword' => 'required',
        ]);

        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                'keyword' => $request->keyword,
                'blog_posts' => BlogPost::where("post_title", "LIKE", '%' . $request->keyword . '%')->where("status", "published")->where("visibility", "public")->get(),
            ],
        ], 200);
    }

    /**
     * testimonials
     *
     * @return void
     */
    public function testimonials()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "testimonials" => Testimonial::orderBy("id", "desc")->get(),
            ],
        ], 200);
    }

    /**
     * businessReviews
     *
     * @param Request request
     *
     * @return void
     */
    public function businessReviews(Request $request)
    {
        $validator = $this->validate($request, [
            'business_id' => 'required',
        ]);

        $business = Business::find($request->business_id);
        if (isset($business)) {

            $reviews = BusinessReviews::where("business_id", $request->business_id)->get();

            return new JsonResponse([
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'rating' => $business->rating,
                    'total_reviews' => $reviews->count(),
                    'reviews' => $reviews,
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'status_code' => (int) 400,
                'status' => "Failed",
                'message' => "Business with the provided business id does not exist",
            ], 400);
        }
    }

    /**
     * artisansList
     *
     * @return void
     */
    public function artisansList()
    {
        return new JsonResponse([
            'status_code' => (int) 200,
            'status' => "Successful",
            'data' => [
                "artisans" => Artisans::whereNotNull("biography")->whereNotNull("profession")->get(),
            ],
        ], 200);
    }

    /**
     * artisanDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function artisanDetails(Request $request)
    {
        $validator = $this->validate($request, [
            'artisan_id' => 'required',
        ]);

        $artisan = Artisans::find($request->artisan_id);
        if (isset($artisan)) {

            return new JsonResponse([
                'status_code' => (int) 200,
                'status' => "Successful",
                'data' => [
                    'artisan' => $artisan,
                    'reviews' => ArtisanReviews::where("artisan_id", $request->artisan_id)->get(),
                ],
            ], 200);
        } else {
            return new JsonResponse([
                'status_code' => (int) 400,
                'status' => "Failed",
                'message' => "Artisan with the provided artisan id does not exist",
            ], 400);
        }
    }
}
