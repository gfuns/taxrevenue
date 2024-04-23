<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumTopics extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany('App\Models\ForumPosts', "forum_topic_id");
    }
}
