<?php
namespace App\Http\Controllers;

use App\models\PaymentItem;

class AjaxController extends Controller
{
    public function getTaxItems($mda)
    {

        $taxItems = PaymentItem::where('mda_id', $mda)->where("fee_config", "fixed")->pluck('revenue_item', 'id');

        return response()->json($taxItems);
    }

    public function getTaxAmount($taxId)
    {

        $taxAmount = PaymentItem::find($taxId);

        return response()->json(['amount' => $taxAmount->amount]);

        return response()->json($taxAmount);
    }

}
