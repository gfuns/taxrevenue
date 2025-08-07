<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantRequests extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tax_payer_id',
        'consultant_id',
        'status',
    ];

    public function consultant()
    {
        return $this->belongsTo('App\Models\TaxConsultants', 'consultant_id');
    }
}
