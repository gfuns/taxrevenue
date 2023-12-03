<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformCategories extends Model
{
    use HasFactory;

    protected $appends = array('jobs');

    public function getJobsAttribute()
    {
        $jobs = JobListing::where("job_categories", "LIKE", '%' . $this->id . '%')->count();
        return (int) $jobs;
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
