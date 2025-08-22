<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessments extends Model
{
    use HasFactory;

    public function return ()
    {
        return $this->belongsTo('App\Models\Returns', 'returns_id');
    }

    public function taxpayer()
    {
        return $this->belongsTo('App\Models\TaxPayer', 'tax_payer_id');
    }
}
