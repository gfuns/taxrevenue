<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformCategories extends Model
{
    use HasFactory;

    protected $appends = array('businesses');

    public function getBusinessesAttribute()
    {
        $businesses = Business::where("business_category", $this->category_name)->count();
        return (int) $businesses;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }
}
