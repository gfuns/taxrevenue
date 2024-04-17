<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(){
        return view("forum.index");
    }


    public function bookmarks(){
        return view("forum.bookmarks");
    }

    public function popularPosts(){
        return view("forum.popular_posts");
    }

    public function categoryPosts($id){
        return view("forum.category_posts", compact("id"));
    }

    public function topicPosts($id){
        return view("forum.topic_posts", compact("id"));
    }
}
