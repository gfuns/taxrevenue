<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSubscription extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\SubscriptionPlan', 'plan_id');
    }

    public function card()
    {
        return $this->belongsTo('App\Models\CustomerCards', 'card_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'updated_at',
    ];
}
