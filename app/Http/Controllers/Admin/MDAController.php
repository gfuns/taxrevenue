<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentItem;
use Auth;
use Carbon\Carbon;

class MDAController extends Controller
{
    //
    /**
     * dashboard
     *
     * @return void
     */
    public function dashboard()
    {

        $params = [
            "regs"     => 0,
            "renewals" => 0,
            "poas"     => 0,
            "awards"   => 0,
            "prFees"   => 0,
        ];

        $year   = Carbon::now()->year;
        $months = collect(range(1, 12));

        $datasets = [
            'registrations' => [],
            'renewals'      => [],
            'poa'           => [],
            'award_letters' => [],
            'processing'    => [],
        ];

        foreach ($months as $m) {
            $datasets['registrations'][] = 0;

            $datasets['renewals'][] = 0;

            $datasets['poa'][] = 0;

            $datasets['award_letters'][] = 0;

            $datasets['processing'][] = 0;
        }

        $dataSets = json_encode($datasets);

        return view("mda.dashboard", compact("params", "dataSets"));

    }

    /**
     * profile
     *
     * @return void
     */
    public function viewProfile()
    {
        return view("mda.profile");
    }

    /**
     * security
     *
     * @return void
     */
    public function security()
    {
        $google2fa       = app('pragmarx.google2fa');
        $google2faSecret = $google2fa->generateSecretKey();
        $QRImage         = $google2fa->getQRCodeInline(
            env('APP_NAME'),
            Auth::user()->email,
            $google2faSecret
        );
        return view("mda.security", compact("google2faSecret", "QRImage"));
    }

    /**
     * administrativeReports
     *
     * @return void
     */
    public function administrativeReports()
    {
        alert()->info('Coming Soon');
        return back();
    }

    /**
     * revenueItems
     *
     * @return void
     */
    public function revenueItems()
    {
        $search = request()->search;
        $status = request()->status;

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord   = PaymentItem::query()->where("mda_id", 1)->whereLike(["revenue_item", "revenue_code"], $search)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $paymentItems = PaymentItem::query()->where("mda_id", 1)->whereLike(["revenue_item", "revenue_code"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord   = PaymentItem::query()->where("mda_id", 1)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $paymentItems = PaymentItem::query()->where("mda_id", 1)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord   = PaymentItem::query()->where("mda_id", 1)->whereLike(["revenue_item", "revenue_code"], $search)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $paymentItems = PaymentItem::query()->where("mda_id", 1)->whereLike(["revenue_item", "revenue_code"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = PaymentItem::where("mda_id", 1)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $paymentItems = PaymentItem::where("mda_id", 1)->paginate(50);
        }
        return view("mda.revenue_items", compact("paymentItems", "search", "status", "lastRecord", "marker"));
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
        $end    = (50 * ((int) $pageNum));
        $marker = [];
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
