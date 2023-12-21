<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\UtilityTransactions;
use Auth;
use Illuminate\Http\Request;

class UtilityController extends Controller
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

    public function utilityTransactions(Request $request)
    {
        $service = request()->service;
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->service) && !isset(request()->status)) {
            //Only Search has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && isset(request()->service) && !isset(request()->status)) {
            //Search and service has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("trx_type", $service)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", $service)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && !isset(request()->service) && isset(request()->status)) {
            //Search and status has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("status", $status)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("status", $status)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && isset(request()->service) && isset(request()->status)) {
            //Search, service and status has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("trx_type", $service)->where("status", $status)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", $service)->where("status", $status)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->service) && isset(request()->status)) {
            //Service and status has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("trx_type", $service)->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", $service)->where("status", $status)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->service) && !isset(request()->status)) {
            //Only Service has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("trx_type", $service)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("trx_type", $service)->paginate(50);

        } else if (!isset(request()->search) && !isset(request()->service) && isset(request()->status)) {
            //Only Status has a value
            $lastRecord = UtilityTransactions::query()->where("customer_id", Auth::user()->id)->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->orderBy("id", "desc")->where("customer_id", Auth::user()->id)->where("status", $status)->paginate(50);

        } else {
            $lastRecord = UtilityTransactions::where("customer_id", Auth::user()->id)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::orderBy("id", "desc")->where("customer_id", Auth::user()->id)->paginate(50);
        }
        return view("business.utility_transactions", compact("transactions", "lastRecord", "marker", "search", "service", "status"));

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
            $marker["begin"] = number_format(((50 * ((int) $pageNum)) - 49), 0);
            $marker["index"] = number_format(((50 * ((int) $pageNum)) - 49), 0);
        }

        if ($end > $lastRecord) {
            $marker["end"] = number_format($lastRecord, 0);
        } else {
            $marker["end"] = number_format($end, 0);
        }

        return $marker;
    }

}
