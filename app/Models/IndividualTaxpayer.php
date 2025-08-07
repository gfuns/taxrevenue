<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualTaxpayer extends Model
{
    use HasFactory;

    public function office()
    {
        return $this->belongsTo('App\Models\TaxOffice', 'tax_office_id');
    }
}
