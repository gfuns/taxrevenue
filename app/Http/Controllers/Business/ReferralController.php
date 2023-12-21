<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Referral;
use Auth;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function referrals(Request $request)
    {
        $business = Business::where("customer_id", Auth::user()->id)->first();

        if (isset($request->search)) {

            $search = $request->search;

            $records = Referral::with(['customer']);

            /**
             * Searching the names key inside
             * the user relationship
             */
            $records->where(fn($query) =>
                $query->whereHas('customer', fn($query2) =>
                    $query2->where('first_name', 'LIKE', $request->search . '%')->orWhere('last_name', 'LIKE', $request->search . '%'))
            );

            /**
             * Returning the response
             */

            $referrals = collect($records->get());
            $marker = null;
            $lastRecord = null;

        } else {
            $search = null;
            $lastRecord = Referral::where("customer_id", Auth::user()->id)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $referrals = Referral::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->paginate(50);
        }

        return view("business.referrals", compact("business", "referrals", "lastRecord", "marker", "search"));
    }

    /**
     * getMarkers Helper Function
     *
     * @param mixed lastRecord
     * @param mixed pageNum
     *
     * @return void
     */
    public function getMarkers($lastRecord, $pageNum)
    {
        if ($pageNum == null) {
            $pageNum = 1;
        }
        $end = (50 * ((int) $pageNum));
        $marker = array();
        if ((int) $pageNum == 1) {
            $marker["begin"] = (int) $pageNum;
            $marker["index"] = (int) $pageNum;
        } else {
            $marker["begin"] = number_format(((6 * ((int) $pageNum)) - 49), 0);
            $marker["index"] = number_format(((6 * ((int) $pageNum)) - 49), 0);
        }

        if ($end > $lastRecord) {
            $marker["end"] = number_format($lastRecord, 0);
        } else {
            $marker["end"] = number_format($end, 0);
        }

        return $marker;
    }

}
