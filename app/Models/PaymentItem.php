<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    use HasFactory;

    public function amountInWords()
    {
        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);
        $inWords   = ucwords($formatter->format($this->amount));
        return $inWords;
    }
}
