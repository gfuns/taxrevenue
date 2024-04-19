<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComments extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', "customer_id");
    }

    public function replies()
    {
        return $this->hasMany('App\Models\PostComments', "comment_id");
    }
}
