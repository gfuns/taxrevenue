<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateChat extends Model
{
    use HasFactory;

    protected $appends = array('chat_id', 'sender_name', 'sender_photo', 'recipient_name', 'recipient_photo');

    public function getChatIdAttribute()
    {
        return $this->attributes['id'];
    }

    public function getSenderNameAttribute()
    {
        $customer = Customer::find($this->sender_id);
        if (isset($customer)) {
            return $customer->first_name . " " . $customer->last_name;
        } else {
            return "No Name";
        }
    }

    public function getRecipientNameAttribute()
    {
        $customer = Customer::find($this->recipient_id);
        if (isset($customer)) {
            return $customer->first_name . " " . $customer->last_name;
        } else {
            return "No Name";
        }
    }

    public function getSenderPhotoAttribute()
    {
        $customer = Customer::find($this->sender_id);
        if (isset($customer)) {

            return $customer->photo == null ? 'https://res.cloudinary.com/soha/image/upload/v1697107584/kcpamurvjbsgricxchn1.jpg' : $customer->photo;

        } else {
            return null;
        }
    }

    public function getRecipientPhotoAttribute()
    {

        $customer = Customer::find($this->recipient_id);
        if (isset($customer)) {

            return $customer->photo == null ? 'https://res.cloudinary.com/soha/image/upload/v1697107584/kcpamurvjbsgricxchn1.jpg' : $customer->photo;

        } else {
            return null;
        }
    }

    public function getSenderIdAttribute($value)
    {
        return (integer) $value;
    }

    public function getRecipientIdAttribute($value)
    {
        return (integer) $value;
    }

    public function getName($id)
    {
        $customer = Customer::find($id);
        if (isset($customer)) {

            return $customer->first_name . " " . $customer->last_name;

        } else {
            return null;
        }
    }

    public function getPhoto($id)
    {
        $customer = Customer::find($id);
        if (isset($customer)) {

            return $customer->photo == null ? 'https://res.cloudinary.com/soha/image/upload/v1697107584/kcpamurvjbsgricxchn1.jpg' : $customer->photo;

        } else {
            return null;
        }
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'sender_deleted',
        'recipient_deleted',
        'created_at',
        'updated_at',
    ];
}
