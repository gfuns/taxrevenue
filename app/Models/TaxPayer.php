<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TaxPayer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function individual()
    {
        return $this->hasOne('App\Models\IndividualTaxpayer', 'tax_payer_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tax_payer',
        'btin',
        'category',
    ];

    public static function booted()
    {
        static::creating(function ($taxpayer) {
            $taxpayer->btin = self::genTIN();
        });

    }

    public static function genTIN()
    {
        // Get the current timestamp
        $timestamp = (string) (strtotime('now') . microtime(true));

        $uuid = Str::uuid()->toString();

        $mergedData = $timestamp . $uuid;

        // Remove any non-numeric characters (like dots)
        $reference = preg_replace('/[^0-9]/', '', $mergedData);

        return "B-" . substr(str_shuffle($reference), 0, 8);

    }
}
