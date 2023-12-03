<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateConversation extends Model
{
    use HasFactory;

    protected $appends = array('sender_name');

    public function getSenderNameAttribute()
    {
        $sender = Customer::find($this->sender_id);
        if ($sender != null) {
            return $sender->first_name . " " . $sender->last_name;
        } else {
            return null;
        }
    }

    public function getFileSizeAttribute($value)
    {
        return (integer) $value;
    }

    public function getPrivateChatIdAttribute($value)
    {
        return (integer) $value;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'status',
        'created_at',
        'sender_deleted',
        'recipient_deleted',
    ];
}
