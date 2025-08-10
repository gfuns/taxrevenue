<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use NumberToWords\NumberToWords;

class PaymentHistory extends Model
{
    use HasFactory;

    public function amountInWords()
    {

        $numberToWords     = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $inWords           = $numberTransformer->toWords($this->amount);
        return ucwords($inWords);
    }

    public function mda()
    {
        return $this->belongsTo('App\Models\Mda', 'mda_id');
    }

    public function office()
    {
        return $this->belongsTo('App\Models\TaxOffice', 'tax_office_id');
    }

    public function tax()
    {
        return $this->belongsTo('App\Models\PaymentItem', 'payment_item_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function taxpayer()
    {
        return $this->belongsTo('App\Models\TaxPayer', 'tax_payer_id');
    }

    public static function booted()
    {
        static::creating(function ($payment) {
            $payment->reference = self::genPaymentReference();
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
