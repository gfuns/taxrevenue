<?php

namespace App\Http\Controllers;

use App\Models\ForumPosts;
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

        return view("forum.post_details", compact("post"));
    }

    public function votePost(Request $request)
    {
        $post = ForumPosts::find($request->post_id);

        if ($request->vote == 1) {
            $post->likes = ($post->likes + 1);
        } else {
            $post->likes = ($post->likes - 1);
        }
        $post->save();

        return $post->likes;
    }
}
