<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPosts extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\ForumCategories', "forum_category_id");
    }

    public function topic()
    {
        return $this->belongsTo('App\Models\ForumTopics', "forum_topic_id");
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', "customer_id");
    }

    public function comments()
    {
        return $this->hasMany('App\Models\PostComments', "forum_post_id");
    }

    public function isBookmarked()
    {
        $bookmark = ForumBookmarks::where("forum_post_id", $this->id)->where("customer_id", Auth::user()->id)->first();
        if (isset($bookmark)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function truncateText($text, $limit)
    {
        $cleanedText = strip_tags($text);
        // Split the text into an array of words
        $words = explode(' ', $cleanedText);

        // If the number of words is greater than the limit, slice the array and rejoin it
        if (count($words) > $limit) {
            $text = implode(' ', array_slice($words, 0, $limit));
        }

        return $text;
    }
}
