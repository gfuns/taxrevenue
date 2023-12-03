<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCards extends Model
{
    use HasFactory, SoftDeletes;

    public function getCardHolderAttribute($value)
    {
        return $value == null ? Auth::user()->first_name . " " . Auth::user()->last_name : $value;
    }

    public function getAuthorizationCodeAttribute($value)
    {
        return decrypt($value);
    }

    public function getDefaultCardAttribute($value)
    {
        return (boolean) $value;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'customer_id',
        'authorization_code',
        'updated_at',
        'deleted_at',
    ];
}
