<?php

namespace App\Http\Controllers;

use App\Models\ForumBookmarks;
use App\Models\ForumCategories;
use App\Models\ForumImages;
use App\Models\ForumPosts;
use App\Models\ForumTopics;
use App\Models\PostComments;
use App\Models\ReportedComments;
use App\Models\ReportedPosts;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPosts::orderBy("id", "desc")->limit(20)->get();
        return view("forum.index", compact("posts"));
    }

    public function userDetails($id = null)
    {
        if (Auth::user()) {
            $posts = ForumPosts::where("customer_id", Auth::user()->id)->get();
            return view("forum.user_posts", compact("posts"));
        } else {
            return redirect()->route("forum.login");
        }
    }

    public function bookmarks()
    {
        if (Auth::user()) {

            $bookmarks = ForumBookmarks::where("customer_id", Auth::user()->id)->pluck("forum_post_id");
            $posts = ForumPosts::whereIn("id", $bookmarks)->get();
            return view("forum.bookmarks", compact("posts"));
        } else {
            return redirect()->route("forum.login");
        }
    }

    public function popularPosts()
    {
        $popularPosts = DB::table('forum_posts')
            ->select('forum_posts.*', DB::raw('COUNT(post_comments.id) as comment_count'))
            ->leftJoin('post_comments', 'forum_posts.id', '=', 'post_comments.forum_post_id')
            ->groupBy('forum_posts.id')
            ->orderByRaw('COUNT(post_comments.id) + forum_posts.views DESC')
            ->get();

        return view("forum.popular_posts", compact("popularPosts"));
    }

    public function categoryPosts($id)
    {
        $posts = ForumPosts::where("forum_category_id", $id)->get();
        return view("forum.category_posts", compact("id", "posts"));
    }

    public function topicPosts($id)
    {
        $posts = ForumPosts::where("forum_topic_id", $id)->get();
        return view("forum.topic_posts", compact("id", "posts"));
    }

    public function postDetails($id, $slug)
    {
        $post = ForumPosts::find($id);
        $post->views = ($post->views + 1);
        $post->save();

        $comments = PostComments::where("forum_post_id", $id)->where("comment_type", "main")->get();

        $postImages = ForumImages::where("forum_post_id", $id)->get();

        return view("forum.post_details", compact("post", "comments", "postImages"));
    }

    public function votePost(Request $request)
    {
        $post = ForumPosts::find($request->post_id);

        if ($request->vote == 1) {
            $post->likes = ($post->likes + 1);
        } else {
            $post->likes = $post->likes == 0 ? 0 : ($post->likes - 1);
        }
        $post->save();

        return $post->likes;
    }

    public function reportPost(Request $request)
    {
        $report = new ReportedPosts;
        $report->forum_post_id = $request->post_id;
        $report->customer_id = Auth::user()->id;
        $report->comment = $request->reason;
        if ($report->save()) {
            return response()->json(['status' => "success", "message" => "We have received your report for the selected post."], 200);
        } else {
            return response()->json(['status' => "error", "errors" => [
                "error" => "Unable to report selected post",
            ]], 400);
        }
    }

    public function bookmarkPost(Request $request)
    {
        $bookMarkExist = ForumBookmarks::where("forum_post_id", $request->post_id)->where("customer_id", Auth::user()->id)->first();
        if (!isset($bookMarkExist)) {
            $bookmark = new ForumBookmarks;
            $bookmark->forum_post_id = $request->post_id;
            $bookmark->customer_id = Auth::user()->id;
            if ($bookmark->save()) {
                return response()->json(['status' => "success", "bookmarktype" => "saved", "message" => "Post successfully added to bookmark."], 200);
            } else {
                return response()->json(['status' => "error", "errors" => [
                    "error" => "Unable to add selected post to bookmark",
                ]], 400);
            }
        } else {
            if ($bookMarkExist->delete()) {
                return response()->json(['status' => "success", "bookmarktype" => "deleted", "message" => "Post successfully removed from bookmark."], 200);
            } else {
                return response()->json(['status' => "error", "errors" => [
                    "error" => "Unable to remove selected post from bookmark",
                ]], 400);
            }
        }

    }

    public function submitComment(Request $request)
    {
        $comment = new PostComments;
        $comment->customer_id = Auth::user()->id;
        $comment->forum_post_id = $request->post_id;
        $comment->comment = $request->comment;

        if ($comment->save()) {
            $post = ForumPosts::find($comment->forum_post_id);

            $html = view('forum.single_comment', ['com' => $comment, "post" => $post])->render();
            return response()->json(['status' => "success", "html" => $html], 200);
        } else {
            return response()->json(['status' => "error", "errors" => [
                "error" => "Unable to comment on this post",
            ]], 400);
        }
    }

    public function replyComment(Request $request)
    {
        $comment = new PostComments;
        $comment->customer_id = Auth::user()->id;
        $comment->forum_post_id = $request->post_id;
        $comment->comment_id = $request->comment_id;
        $comment->comment = $request->comment;
        $comment->comment_type = "reply";

        if ($comment->save()) {
            $post = ForumPosts::find($comment->forum_post_id);

            $html = view('forum.single_reply', ['com' => $comment, "post" => $post])->render();
            return response()->json(['status' => "success", "html" => $html], 200);
        } else {
            return response()->json(['status' => "error", "errors" => [
                "error" => "Unable to comment on this post",
            ]], 400);
        }
    }

    public function updateComment(Request $request)
    {
        $comment = PostComments::find($request->comment_id);
        $comment->comment = $request->comment;

        if ($comment->save()) {
            return response()->json(['status' => "success", "id" => $comment->id, "comment" => [
                "comment" => $comment->comment,
            ]], 200);
        } else {
            return response()->json(['status' => "error", "errors" => [
                "error" => "Unable to comment on this post",
            ]], 400);
        }
    }

    public function voteComment(Request $request)
    {
        $comment = PostComments::find($request->comment_id);

        if ($request->vote == 1) {
            $comment->likes = ($comment->likes + 1);
        } else {
            $comment->likes = $comment->likes == 0 ? 0 : ($comment->likes - 1);
        }
        $comment->save();

        return $comment->likes;
    }

    public function deleteComment(Request $request)
    {
        $comment = PostComments::find($request->comment_id);
        $replies = PostComments::where("comment_id", $request->comment_id)->delete();
        if ($comment->delete()) {
            return response()->json(['status' => "success", "commentDeleteCount" => 1], 200);
        } else {
            return response()->json(['status' => "error", "commentDeleteCount" => [
                "error" => "Unable to delete this comment",
            ]], 400);
        }

    }

    public function deleteReply(Request $request)
    {
        $comment = PostComments::find($request->comment_id);
        if ($comment->delete()) {
            return response()->json(['status' => "success", "id" => $request->comment_id, "commentDeleteCount" => 1], 200);
        } else {
            return response()->json(['status' => "error", "commentDeleteCount" => [
                "error" => "Unable to delete this reply",
            ]], 400);
        }

    }

    public function reportComment(Request $request)
    {
        $report = new ReportedComments;
        $report->post_comment_id = $request->comment_id;
        $report->customer_id = Auth::user()->id;
        $report->comment = $request->reason;
        if ($report->save()) {
            return response()->json(['status' => "success", "message" => "We have received your report for the selected comment."], 200);
        } else {
            return response()->json(['status' => "error", "errors" => [
                "error" => "Unable to report selected comment",
            ]], 400);
        }
    }

    public function testHTMLRendering()
    {
        $comment = PostComments::find(3);
        $post = ForumPosts::find(1);
        $html = view('forum.single_comment', ['com' => $comment, "post" => $post])->render();
        dd($html);
    }

    /**
     * storeForumPost
     *
     * @param Request request
     *
     * @return void
     */
    public function userPostStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_title' => 'required',
            'post_body' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $post = new ForumPosts;
            $post->post_body = $request->post_body;
            $post->customer_id = Auth::user()->id;
            $post->forum_category_id = $request->category;
            $post->forum_topic_id = $request->topic;
            $post->post_title = $request->post_title;
            $post->slug = preg_replace("/ /", "-", strtolower($request->post_title));
            $post->save();

            if ($request->hasFile('post_images')) {
                foreach ($request->file('post_images') as $image) {
                    $forumImages = new ForumImages;
                    $forumImages->forum_post_id = $post->id;
                    $forumImages->image = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    $forumImages->save();
                }
            }

            toast('Post Added to Forum Successfully.', 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }

    }

    public function userPostEdit($id)
    {
        $post = ForumPosts::find($id);
        $postImages = ForumImages::where("forum_post_id", $id)->get();
        $forumCategories = ForumCategories::all();
        $forumTopics = ForumTopics::all();
        return view("forum.edit_post", compact("post", "postImages", "forumTopics", "forumCategories"));
    }

    /**
     * updateForumPost
     *
     * @param Request request
     *
     * @return void
     */
    public function userPostUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'post_title' => 'required',
            'post_body' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $post = ForumPosts::find($request->post_id);
            $post->post_body = $request->post_body;
            $post->forum_category_id = $request->fcategory;
            $post->forum_topic_id = $request->ftopic;
            $post->post_title = $request->post_title;
            $post->slug = preg_replace("/ /", "-", strtolower($request->post_title));
            $post->save();

            if ($request->hasFile('post_images')) {
                foreach ($request->file('post_images') as $image) {
                    $forumImages = new ForumImages;
                    $forumImages->forum_post_id = $post->id;
                    $forumImages->image = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    $forumImages->save();
                }
            }

            toast('Post updated Successfully.', 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }

    }

    public function userDeleteImage(Request $request)
    {
        $forumImage = ForumImages::find($request->id);
        if ($forumImage->delete()) {
            return response()->json(['status' => "success", "message" => "Image Deleted."], 200);
        } else {
            return response()->json(['status' => "error", "errors" => [
                "error" => "Something Went Wrong",
            ]], 400);

        }
    }

    public function login()
    {
        return view("auth.forum");
    }

    public function changeLanguage()
    {
        return redirect("/forum");
    }
}
