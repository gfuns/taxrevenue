<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantRequests extends Model
{
    use HasFactory;

    public function consultant()
    {
        return $this->belongsTo('App\Models\TaxConsultants', 'consultant_id');
    }
}
