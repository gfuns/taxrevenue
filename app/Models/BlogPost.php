<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $appends = array('publisher');

    public function getPublisherAttribute()
    {
        return $this->user->first_name . " " . $this->user->last_name;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user',
        'user_id',
        'updated_at',
    ];
}
