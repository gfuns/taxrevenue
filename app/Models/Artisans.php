<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisans extends Model
{
    use HasFactory;

    protected $appends = array('artisan', 'artisan_photo', 'country');

    public function getArtisanAttribute()
    {
        $artisan = Customer::find($this->attributes['customer_id']);
        return $artisan->first_name . " " . $artisan->last_name;
    }

    public function getCountryAttribute()
    {
        $artisan = Customer::find($this->attributes['customer_id']);
        return $artisan->country;
    }

    public function getArtisanPhotoAttribute()
    {
        $artisan = Customer::find($this->attributes['customer_id']);
        return $artisan->photo == null ? "https://res.cloudinary.com/soha/image/upload/v1698927551/l6edizafzfculb2mftwl.webp" : $artisan->photo;
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function artsanReviews()
    {
        return $this->hasMany('App\Models\ArtisanReviews', 'artisan_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'biography',
        'profession',
        'skills',
        'rating',

    ];

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
