<?php
namespace App\Models;

use App\Models\CompanyRenewals;
use Carbon\Carbon;
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

    public function selectedIds()
    {
        $ids = explode(',', $this->business_category);
        return $ids;
    }

    public function nextRenewal()
    {
        $renewal = CompanyRenewals::orderBy("id", "desc")->where("company_id", $this->id)->where("status", "approved")->first();
        if (isset($renewal) && ! empty($renewal)) {
            $date       = Carbon::parse($renewal->created_at); // Replace with your input date
            $expiryDate = $date->addYear($renewal->period);
            return $expiryDate;

        } else {
            $date       = Carbon::parse($this->created_at); // Replace with your input date
            $expiryDate = $date->addYear();

            return $expiryDate;
        }

    }
}
