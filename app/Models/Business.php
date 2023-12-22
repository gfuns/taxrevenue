<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    public function getBusinessLogoAttribute($value)
    {
        return $value == null ? 'https://res.cloudinary.com/soha/image/upload/v1698927551/l6edizafzfculb2mftwl.webp' : $value;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\PlatformCategories', 'category_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\BusinessReviews');
    }

    public function jobListing()
    {
        return $this->hasMany('App\Models\JobListing');
    }

    public function businessLogo()
    {
        return $this->attributes['business_logo'];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'category_id',
        'business_logo',
        'business_name',
        'business_category',
        'business_email',
        'business_phone',
        'business_description',
        'website_url',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'longitude',
        'latitude',
        'visibility',
        'rating',
        'country',
        'state',
        'city',
        'street',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'customer_id',
        'category_id',
        'longitude',
        'latitude',
        'place_name',
        'visibility',
        'updated_at',
    ];
}
