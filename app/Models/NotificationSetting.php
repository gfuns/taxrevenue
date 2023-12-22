<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use HasFactory;

    public function getPushNotificationAttribute($value)
    {
        return (bool) $value;
    }

    public function getEmailNotificationAttribute($value)
    {
        return (bool) $value;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'push_notification',
        'email_notification',
        'unusual_activity',
        'new_browser_signin',
        'latest_news',
        'features_updates',
        'account_tips',
        'all_not',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'customer_id',
        'created_at',
        'updated_at',
    ];
}
