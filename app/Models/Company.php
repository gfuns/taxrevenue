<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getCategories()
    {
        $ids = explode(',', $this->business_category);
        return BusinessCategories::whereIn('id', $ids)->pluck('category')->implode(', ');
    }
}
