<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtisanReviews extends Model
{
    use HasFactory;

    protected $appends = array('reviewer', 'reviewer_photo');

    public function getReviewerAttribute()
    {
        $reviewer = Customer::find($this->attributes['customer_id']);
        return $reviewer->first_name . " " . $reviewer->last_name;
    }

    public function getReviewerPhotoAttribute()
    {
        $reviewer = Customer::find($this->attributes['customer_id']);
        return $reviewer->photo == null ? "https://res.cloudinary.com/soha/image/upload/v1698927551/l6edizafzfculb2mftwl.webp" : $reviewer->photo;
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Business');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'customer_id',
        'artisan_id',
        'updated_at',
    ];
}
