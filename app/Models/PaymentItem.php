<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberToWords\NumberToWords;

class PaymentItem extends Model
{
    use HasFactory;

    public function amountInWords()
    {

        $numberToWords     = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $inWords           = $numberTransformer->toWords($this->amount);
        return ucwords($inWords);
    }
}
