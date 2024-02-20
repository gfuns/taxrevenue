<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $appends = array('featured_images', 'featured_files', 'business_logo', 'business_name');

    public function getFeaturedImagesAttribute()
    {
        $images = JobAssets::where("job_listing_id", $this->attributes['id'])->where("asset_type", "image")->get();
        return $images;
    }

    public function getFeaturedFilesAttribute()
    {
        $files = JobAssets::where("job_listing_id", $this->attributes['id'])->where("asset_type", "file")->get();
        return $files;
    }

    public function getBusinessLogoAttribute()
    {
        return $this->customer->business->business_logo;
    }

    public function getBusinessNameAttribute()
    {
        return $this->customer->business->business_name;
    }

    public function getMinimumSalaryAttribute($value)
    {
        return (double) $value;
    }

    public function getMaximumSalaryAttribute($value)
    {
        return (double) $value;
    }

    public function getTagsAttribute($value)
    {
        return array_map('strval', explode(',', preg_replace("/ /", "", $value)));
    }

    public function getOriginalTags($value)
    {
        $this->attributes['tags'];
    }

    public function getOriginalCategories()
    {
        return $this->attributes['job_categories'];
    }

    public function getJobCategoriesAttribute($value)
    {
        $catIds = explode(',', preg_replace("/ /", "", $value));
        $categories = PlatformCategories::whereIn('id', $catIds)->get();
        return $categories->makeHidden(['jobs']);
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
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
        'updated_at',
    ];
}
