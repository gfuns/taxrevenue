<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $mda    = Auth::user()->mda_id;

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord   = PaymentItem::query()->where("mda_id", $mda)->whereLike(["revenue_item", "revenue_code"], $search)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $paymentItems = PaymentItem::query()->where("mda_id", $mda)->whereLike(["revenue_item", "revenue_code"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord   = PaymentItem::query()->where("mda_id", $mda)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $paymentItems = PaymentItem::query()->where("mda_id", $mda)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord   = PaymentItem::query()->where("mda_id", $mda)->whereLike(["revenue_item", "revenue_code"], $search)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $paymentItems = PaymentItem::query()->where("mda_id", $mda)->whereLike(["revenue_item", "revenue_code"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = PaymentItem::where("mda_id", $mda)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $paymentItems = PaymentItem::where("mda_id", $mda)->paginate(50);
        }
        return view("mda.revenue_items", compact("paymentItems", "search", "status", "lastRecord", "marker", "mda"));
    }

    /**
     * paymentHistory
     *
     * @return void
     */
    public function paymentHistory()
    {
        $search = request()->search;
        $status = request()->status;
        $mda    = Auth::user()->mda_id;

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord     = PaymentHistory::query()->where("mda_id", $mda)->where("reference", $search)->count();
            $marker         = $this->getMarkers($lastRecord, request()->page);
            $paymentHistory = PaymentHistory::query()->where("mda_id", $mda)->where("reference", $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord     = PaymentHistory::query()->where("mda_id", $mda)->where("status", $status)->count();
            $marker         = $this->getMarkers($lastRecord, request()->page);
            $paymentHistory = PaymentHistory::query()->where("mda_id", $mda)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord     = PaymentHistory::query()->where("mda_id", $mda)->where("reference", $search)->where("status", $status)->count();
            $marker         = $this->getMarkers($lastRecord, request()->page);
            $paymentHistory = PaymentHistory::query()->where("mda_id", $mda)->where("reference", $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord     = PaymentHistory::where("mda_id", $mda)->count();
            $marker         = $this->getMarkers($lastRecord, request()->page);
            $paymentHistory = PaymentHistory::where("mda_id", $mda)->paginate(50);
        }
        return view("mda.payment_history", compact("paymentHistory", "search", "status", "lastRecord", "marker", "mda"));
    }

    /**
     * paymentDetails
     *
     * @param mixed id
     *
     * @return void
     */
    public function paymentDetails($reference)
    {
        $trx = PaymentHistory::where("reference", $reference)->first();
        return view("mda.payment_details", compact("trx"));
    }

    /**
     * generateBill
     *
     * @return void
     */
    public function generateBill()
    {
        $mda          = Auth::user()->mda_id;
        $paymentItems = PaymentItem::where("mda_id", $mda)->get();
        return view("mda.generate_bill", compact("paymentItems"));
    }

    /**
     * initiateBillGeneration
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateBillGeneration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'btin'         => 'nullable',
            'tax_payer'    => 'required',
            'revenue_item' => 'required',
            'start_period' => 'required',
            'end_period'   => 'required',
            'amount'       => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $revenueItem = PaymentItem::find($request->revenue_item);

        $amount = $revenueItem->amount ?? $request->amount;

        $feeCharged = self::getFee($revenueItem->id, $amount);

        if (isset($request->btin)) {
            $taxpayer = TaxPayer::where("btin", $request->btin)->first();
        }

        $bill = new PaymentHistory;
        if (isset($request->btin)) {
            $bill->user_id       = isset($taxpayer) ? $taxpayer->user_id : null;
            $bill->tax_payer_id  = isset($taxpayer) ? $taxpayer->id : null;
            $bill->tax_office_id = isset($taxpayer) ? $taxpayer->individual->tax_office_id : null;
        }
        $bill->tax_payer       = $request->tax_payer;
        $bill->period          = $request->start_period . " - " . $request->end_period;
        $bill->mda_id          = Auth::user()->mda_id;
        $bill->narration       = $revenueItem->revenue_item . " Payment";
        $bill->payment_item_id = $revenueItem->id;
        $bill->payment_type_id = $revenueItem->payment_type_id;
        $bill->amount          = $amount;
        $bill->fee_charged     = $feeCharged;
        $bill->total           = ($amount + $feeCharged);
        if ($bill->save()) {
            toast('Bill Generated Successfully.', 'success');
            return redirect()->route("mda.billPreview", [$bill->reference]);
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * billPreview
     *
     * @param mixed reference
     *
     * @return void
     */
    public function billPreview($reference)
    {
        $trx = PaymentHistory::where("reference", $reference)->first();
        return view("mda.bill_preview", compact("trx"));
    }

    /**
     * downloadPayAdvise
     *
     * @param mixed reference
     *
     * @return void
     */
    public function downloadPayAdvise($reference)
    {
        $trx = PaymentHistory::where("reference", $reference)->first();
        return view("mda.bill_preview", compact("trx"));
    }

    /**
     * getFee
     *
     * @param mixed id
     * @param mixed amount
     *
     * @return void
     */
    public static function getFee($id, $amount)
    {
        $item = PaymentItem::find($id);
        $fee  = ((env("BDIC_FEE_PERCENT") / 100) * ($item->amount ?? $amount));
        return $fee;

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
