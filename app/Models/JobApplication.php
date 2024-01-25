<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    public function jobListing()
    {
        return $this->belongsTo('App\Models\JobListing');
    }

    public function artisan()
    {
        return $this->belongsTo('App\Models\Artisans');
    }
}
