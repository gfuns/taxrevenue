<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxOffice extends Model
{
    use HasFactory;

    public function lga()
    {
        return $this->belongsTo('App\Models\Lgas', 'lga_id');
    }
}
