<?php

namespace App\Http\Controllers;

use App\Models\ForumBookmarks;
use App\Models\ForumPosts;
use App\Models\PostComments;
use App\Models\ReportedComments;
use App\Models\ReportedPosts;
use Auth;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPosts::orderBy("id", "desc")->limit(20)->get();
        return view("forum.index", compact("posts"));
    }

    public function bookmarks()
    {
        return view("forum.bookmarks");
    }

    public function popularPosts()
    {
        return view("forum.popular_posts");
    }

    public function categoryPosts($id)
    {
        return view("forum.category_posts", compact("id"));
    }

    public function topicPosts($id)
    {
        return view("forum.topic_posts", compact("id"));
    }

    public function postDetails($id, $slug)
    {
        $post = ForumPosts::find($id);
        $post->views = ($post->views + 1);
        $post->save();

        $comments = PostComments::where("forum_post_id", $id)->where("comment_type", "main")->get();

        return view("forum.post_details", compact("post", "comments"));
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

        $html = '';
        if ($comment->save()) {
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
            return response()->json(['status' => "success", "comment" => [
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
        if ($comment->delete()) {
            return response()->json(['status' => "success", "commentDeleteCount" => 1], 200);
        } else {
            return response()->json(['status' => "error", "commentDeleteCount" => [
                "error" => "Unable to comment on this post",
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
}
