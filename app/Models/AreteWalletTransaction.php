<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreteWalletTransaction extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
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
        'id',
        'customer_id',
        'card_id',
        'bank',
        'account_name',
        'account_number',
        'payment_method',
        'reference',
        'updated_at',
    ];
}
