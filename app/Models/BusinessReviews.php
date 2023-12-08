<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessReviews extends Model
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

    public function artisan()
    {
        return $this->belongsTo('App\Models\Artisans');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'customer_id',
        'business_id',
        'updated_at',
    ];
}
