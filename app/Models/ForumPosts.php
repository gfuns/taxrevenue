<?php

namespace App\Models;

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
}
