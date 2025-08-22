<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Returns extends Model
{
    use HasFactory;

    public function incomeSources()
    {
        return $this->hasOne('App\Models\IncomeSource', 'returns_id');
    }

    public static function booted()
    {
        static::creating(function ($return) {
            $return->reference = self::genPaymentReference();
        });

    }

    public static function genPaymentReference()
    {
        // Get the current timestamp
        $timestamp = (string) (strtotime('now') . microtime(true));

        $uuid = Str::uuid()->toString();

        $mergedData = $timestamp . $uuid;

        // Remove any non-numeric characters (like dots)
        $reference = preg_replace('/[^0-9]/', '', $mergedData);

        return substr(str_shuffle($reference), 0, 12);

    }
}
