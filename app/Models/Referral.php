<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $appends = array('referral');

    public function getReferralAttribute($value)
    {
        $customer = Customer::find($this->attributes['referral_id']);
        return $customer->first_name . " " . $customer->last_name;
    }

    public function getVerifiedAttribute($value)
    {
        return (bool) $value;
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', "referral_id");
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'referral_id',
        'verified',
        'bonus_received',
        'referral_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'customer_id',
        'referral_id',
        'updated_at',
    ];
}
