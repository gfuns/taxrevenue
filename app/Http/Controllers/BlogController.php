<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
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

    /**
     * newBlogPost
     *
     * @return void
     */
    public function newBlogPost()
    {
        return view('new_blog_post');
    }

    /**
     * storeBlogPost
     *
     * @param Request request
     *
     * @return void
     */
    public function storeBlogPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'visibility' => 'required',
            'post_title' => 'required',
            'featured_image' => 'required',
            'blog_post' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $blogPost = new BlogPost;
        $blogPost->user_id = Auth::user()->id;
        $blogPost->post_title = $request->post_title;
        $blogPost->slug = preg_replace("/ /", "-", $request->post_title);
        $blogPost->blog_post = $request->blog_post;
        $blogPost->status = $request->status;
        $blogPost->visibility = $request->visibility;
        if ($request->has('featured_image')) {
            $blogPost->cover_photo = Cloudinary::upload($request->file('featured_image')->getRealPath())->getSecurePath();
        }

        if ($blogPost->save()) {
            toast('Blog Post Added Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while creating blog post", 'error');
            return back();
        }
    }

    /**
     * viewBlogPosts
     *
     * @return void
     */
    public function viewBlogPosts()
    {
        $search = request()->search;
        if (isset(request()->search)) {
            $lastRecord = BlogPost::where("post_title", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $blogPosts = BlogPost::orderBy("id", "desc")->where("post_title", "LIKE", '%' . $search . '%')->paginate(50);
        } else {
            $lastRecord = BlogPost::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $blogPosts = BlogPost::orderBy("id", "desc")->paginate(50);
        }
        return view('blog_posts', compact('blogPosts', 'marker', 'lastRecord', 'search'));
    }

    /**
     * editBlogPost
     *
     * @param mixed id
     *
     * @return void
     */
    public function editBlogPost($id)
    {
        $blogPost = BlogPost::find($id);
        return view('edit_blog_post', compact('blogPost'));
    }

    /**
     * updateBlogPost
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBlogPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_post_id' => 'required',
            'status' => 'required',
            'slug' => 'required',
            'visibility' => 'required',
            'post_title' => 'required',
            'blog_post' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $blogPost = BlogPost::find($request->blog_post_id);
        $blogPost->post_title = $request->post_title;
        $blogPost->slug = $request->slug;
        $blogPost->blog_post = $request->blog_post;
        $blogPost->status = $request->status;
        $blogPost->visibility = $request->visibility;
        if ($request->has('featured_image')) {
            $blogPost->cover_photo = Cloudinary::upload($request->file('featured_image')->getRealPath())->getSecurePath();
        }

        if ($blogPost->save()) {
            toast('Blog Post Updated Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while updating blog post", 'error');
            return back();
        }
    }

    /**
     * deleteBlogPost
     *
     * @param mixed id
     *
     * @return void
     */
    public function deleteBlogPost($id)
    {
        $blogPost = BlogPost::find($id);
        if ($blogPost->delete()) {
            toast('Blog Post Deleted Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while deleting blog post", 'error');
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
