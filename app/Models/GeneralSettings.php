<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;

    public static function scopeAppWeb($query)
    {
        return $query->where("setting", "app_key_web")->first();
    }

    public static function scopeAppMobile($query)
    {
        return $query->where("setting", "app_key_mobile")->first();
    }
}
