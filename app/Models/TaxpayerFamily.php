<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxpayerFamily extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tax_payer_id',
        'btin',
        'relationship',
        'full_name',
        'dob',
        'occupation',
        'business_name',
        'business_address',
    ];
}
