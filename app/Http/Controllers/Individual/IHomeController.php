<?php
namespace App\Http\Controllers\Individual;

use App\Http\Controllers\Controller;
use App\Models\Assessments;
use App\Models\ConsultantRequests;
use App\Models\IncomeSource;
use App\Models\IndividualTaxpayer;
use App\Models\Mda;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\Returns;
use App\Models\TaxConsultants;
use App\Models\TaxOffice;
use App\Models\TaxPayer;
use App\Models\TaxpayerFamily;
use App\Models\taxStations;
use App\Models\UploadedDocuments;
use App\Models\User;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class IHomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {

        if (Auth::user()->profile_updated == 1) {
            return view("individual.dashboard");
        } else {
            return redirect()->route("individual.viewProfile");
        }
    }

    /**
     * profile
     *
     * @return void
     */
    public function viewProfile()
    {
        $taxStations = TaxOffice::all();
        return view("individual.profile", compact("taxStations"));
    }

    /**
     * updateProfile
     *
     * @param Request request
     *
     * @return void
     */
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'last_name'             => 'required',
            'other_names'           => 'required',
            'phone_number'          => 'required',
            'gender'                => 'required',
            'country'               => 'required',
            'marital_status'        => 'required',
            'dob'                   => 'required',
            'state'                 => 'required',
            'lga_origin'            => 'required',
            'identification_type'   => 'required',
            'identification_number' => 'required',
            'tin'                   => 'nullable',
            'annual_income'         => 'required',
            'public_servant'        => 'required',
            'occupation'            => 'required',
            'state_residence'       => 'required',
            'lga_residence'         => 'required',
            'city_residence'        => 'required',
            'house_number'          => 'required',
            'street_name'           => 'required',
            'tax_station'           => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {

            $parsePhone = User::where("email", $request->phone_number)->where("id", "!=", Auth::user()->id)->count();
            if ($parsePhone > 0) {
                toast('Phone number already used by someone else.', 'error');
                return back();
            }
            DB::beginTransaction();

            $taxPayer            = new TaxPayer;
            $taxPayer->user_id   = Auth::user()->id;
            $taxPayer->tax_payer = $request->last_name . " " . $request->other_names;
            $taxPayer->category  = "individual";
            $taxPayer->save();

            $individual                        = new IndividualTaxpayer;
            $individual->user_id               = Auth::user()->id;
            $individual->tax_payer_id          = $taxPayer->id;
            $individual->tax_office_id         = $request->tax_station;
            $individual->last_name             = $request->last_name;
            $individual->other_names           = $request->other_names;
            $individual->gender                = $request->gender;
            $individual->nationality           = $request->country;
            $individual->state_origin          = $request->state;
            $individual->lga_origin            = $request->lga_origin;
            $individual->dob                   = $request->dob;
            $individual->marital_status        = $request->marital_status;
            $individual->identification_type   = $request->identification_type;
            $individual->identification_number = $request->identification_number;
            $individual->tin                   = $request->tin;
            $individual->annual_income         = $request->annual_income;
            $individual->public_servant        = $request->public_servant;
            $individual->occupation            = $request->occupation;
            $individual->state_residence       = $request->state_residence;
            $individual->lga_residence         = $request->lga_residence;
            $individual->city_residence        = $request->city_residence;
            $individual->street_name           = $request->street_name;
            $individual->house_number          = $request->house_number;
            $individual->save();

            $user                  = Auth::user();
            $user->last_name       = $request->last_name;
            $user->other_names     = $request->other_names;
            $user->phone_number    = $request->phone_number;
            $user->profile_updated = 1;
            $user->save();

            DB::commit();

            toast('Profile Information Successfully Updated.', 'success');
            return back();

        } catch (\Exception $e) {
            DB::rollback();
            report($e);
            toast('Something went wrong. Please try again', 'error');
            return back();
        }

    }

    /**
     * addSpouse
     *
     * @param Request request
     *
     * @return void
     */
    public function addSpouse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'btin'             => 'nullable',
            'full_name'        => 'required',
            'dob'              => 'required_without:btin',
            'occupation'       => 'required_without:btin',
            'business_name'    => 'required_without:btin',
            'business_address' => 'required_without:btin',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        if (isset($request->btin)) {
            $taxpayer        = TaxPayer::where("btin", $request->btin)->first();
            $occupation      = $taxpayer->individual->occupation;
            $businessName    = $taxpayer->individual->business_name;
            $businessAddress = $taxpayer->individual->business_address;
            $btin            = $taxpayer->btin;
        }

        if ($family = TaxpayerFamily::updateOrCreate(
            [
                'tax_payer_id' => Auth::user()->taxpayer->id,
                'full_name'    => $taxpayer->tax_payer ?? $request->full_name,
                'btin'         => $btin ?? null,
                'relationship' => "spouse",
            ], [
                'dob'              => $taxpayer->individual->dob ?? $request->dob,
                'occupation'       => $occupation ?? $request->occupation,
                'business_name'    => $businessName ?? $request->business_name,
                'business_address' => $businessAddress ?? $request->business_address,
            ])) {
            toast('Information Added Successfully.', 'success');
            return back();
        }

        toast('Something went wrong.', 'error');
        return back();
    }

    /**
     * addChild
     *
     * @param Request request
     *
     * @return void
     */
    public function addChild(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'btin'             => 'nullable',
            'full_name'        => 'required',
            'dob'              => 'required_without:btin',
            'occupation'       => 'required_without:btin',
            'business_name'    => 'required_without:btin',
            'business_address' => 'required_without:btin',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        if (isset($request->btin)) {
            $taxpayer        = TaxPayer::where("btin", $request->btin)->first();
            $occupation      = $taxpayer->individual->occupation;
            $businessName    = $taxpayer->individual->business_name;
            $businessAddress = $taxpayer->individual->business_address;
            $btin            = $taxpayer->btin;
        }

        if ($family = TaxpayerFamily::updateOrCreate(
            [
                'tax_payer_id' => Auth::user()->taxpayer->id,
                'full_name'    => $taxpayer->tax_payer ?? $request->full_name,
                'btin'         => $btin ?? null,
                'relationship' => "child",
            ], [
                'dob'              => $taxpayer->individual->dob ?? $request->dob,
                'occupation'       => $occupation ?? $request->occupation,
                'business_name'    => $businessName ?? $request->business_name,
                'business_address' => $businessAddress ?? $request->business_address,
            ])) {
            toast('Information Added Successfully.', 'success');
            return back();
        }

        toast('Something went wrong.', 'error');
        return back();
    }

    /**
     * uploadPhoto
     *
     * @param Request request
     *
     * @return void
     */
    public function uploadPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_photo' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $user = Auth::user();
        if ($request->has('profile_photo')) {
            $uploadedFileUrl     = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
            $user->profile_photo = $uploadedFileUrl;
        }

        if ($user->save()) {
            toast('Profile Photo Successfully Uploaded.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
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
        return view("individual.security", compact("google2faSecret", "QRImage"));
    }

    /**
     * taxConsultants
     *
     * @return void
     */
    public function taxConsultants()
    {
        $search = request()->search;
        if (isset(request()->search)) {
            $lastRecord     = TaxConsultants::query()->whereLike(["organization", "surname", "other_names", "email"], $search)->where("status", "active")->count();
            $marker         = $this->getMarkers($lastRecord, request()->page);
            $taxConsultants = TaxConsultants::query()->whereLike(["organization", "surname", "other_names", "email"], $search)->where("status", "active")->paginate(50);
        } else {
            $lastRecord     = TaxConsultants::where("status", "active")->count();
            $marker         = $this->getMarkers($lastRecord, request()->page);
            $taxConsultants = TaxConsultants::where("status", "active")->paginate(50);
        }
        $assignedConsultants = ConsultantRequests::orderBy("id", "desc")->where("user_id", Auth::user()->id)->get();
        return view("individual.tax_consultants", compact("taxConsultants", "assignedConsultants", "search", "lastRecord", "marker"));
    }

    /**
     * taxStations
     *
     * @return void
     */
    public function taxStations()
    {

        $search = request()->search;
        if (isset(request()->search)) {
            $lastRecord = TaxOffice::query()->whereLike(["tax_office"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $taxOffices = TaxOffice::query()->whereLike(["tax_office"], $search)->paginate(50);
        } else {
            $lastRecord = TaxOffice::count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $taxOffices = TaxOffice::paginate(50);
        }
        return view("individual.tax_stations", compact("taxOffices", "search", "lastRecord", "marker"));
    }

    /**
     * generateBill
     *
     * @return void
     */
    public function generateBill()
    {
        $mdas = Mda::all();
        return view("individual.generate_bill", compact("mdas"));
    }

    /**
     * initiateBillPayment
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateBillPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_period' => 'required',
            'end_period'   => 'required',
            'mda'          => 'required',
            'revenue_item' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $revenueItem = PaymentItem::find($request->revenue_item);

        $feeCharged = self::getFee($revenueItem->id);

        $bill                  = new PaymentHistory;
        $bill->user_id         = Auth::user()->id;
        $bill->tax_payer_id    = Auth::user()->taxpayer->id;
        $bill->tax_office_id   = Auth::user()->individual->tax_office_id;
        $bill->period          = $request->start_period . " - " . $request->end_period;
        $bill->mda_id          = $request->mda;
        $bill->narration       = $revenueItem->revenue_item . " Payment";
        $bill->payment_item_id = $revenueItem->id;
        $bill->payment_type_id = $revenueItem->payment_type_id;
        $bill->amount          = $revenueItem->amount;
        $bill->fee_charged     = $feeCharged;
        $bill->total           = ($revenueItem->amount + $feeCharged);
        if ($bill->save()) {
            toast('Bill Generated Successfully.', 'success');
            return redirect()->route("individual.paymentPreview", [$bill->reference]);
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * paymentPreview
     *
     * @param mixed id
     *
     * @return void
     */
    public function paymentPreview($reference)
    {
        $bill = PaymentHistory::where("reference", $reference)->first();
        return view("individual.payment_preview", compact("bill"));
    }

    /**
     * paymentDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function paymentDetails($reference)
    {
        $bill = PaymentHistory::where("reference", $reference)->first();
        return view("individual.payment_details", compact("bill"));
    }

    /**
     * processBillPayment
     *
     * @param Request request
     *
     * @return void
     */
    public function processBillPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reference' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $paymentLog = PaymentHistory::where("reference", $request->reference)->first();

        try {
            $response = Http::accept('application/json')->withHeaders([
                'authorization' => env('CREDO_PUBLIC_KEY'),
                'content_type'  => "Content-Type: application/json",
            ])->post(env("CREDO_URL") . "/transaction/initialize", [
                "customerFirstName"   => Auth::user()->other_names,
                "customerLastName"    => Auth::user()->last_name,
                "customerPhoneNumber" => Auth::user()->phone_number,
                "email"               => Auth::user()->email,
                "amount"              => ($paymentLog->total * 100),
                "reference"           => $paymentLog->reference,
                "narration"           => $paymentLog->narration,
                "callbackUrl"         => route("etranzact.billPayment.callBack"),
                "bearer"              => 0,
            ]);

            $responseData = $response->collect("data");

            if (isset($responseData['authorizationUrl'])) {
                return redirect($responseData['authorizationUrl']);
            }

            toast("Credo E-Tranzact gateway service took too long to respond.", 'error');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast('Error initializing payment gateway. Please try again', 'error');
            return back();
        }
    }

    /**
     * billPayments
     *
     * @return void
     */
    public function billPayments()
    {
        $search = request()->search;
        $status = request()->status;

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord   = PaymentHistory::query()->where("user_id", Auth::user()->id)->where("reference", $search)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = PaymentHistory::query()->where("user_id", Auth::user()->id)->where("reference", $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord   = PaymentHistory::query()->where("user_id", Auth::user()->id)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = PaymentHistory::query()->where("user_id", Auth::user()->id)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord   = PaymentHistory::query()->where("user_id", Auth::user()->id)->where("reference", $search)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = PaymentHistory::query()->where("user_id", Auth::user()->id)->where("reference", $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = PaymentHistory::where("user_id", Auth::user()->id)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = PaymentHistory::where("user_id", Auth::user()->id)->paginate(50);
        }

        return view("individual.bill_payment_history", compact("transactions", "search", "status", "lastRecord", "marker"));
    }

    /**
     * filedReturns
     *
     * @return void
     */
    public function filedReturns()
    {
        $search = request()->search;
        $status = request()->status;

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord   = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 1)->where("reference", $search)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 1)->where("reference", $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord   = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 1)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 1)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord   = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 1)->where("reference", $search)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 1)->where("reference", $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = Returns::where("user_id", Auth::user()->id)->where("self_filed", 1)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Returns::where("user_id", Auth::user()->id)->where("self_filed", 1)->paginate(50);
        }

        return view("individual.filed_returns", compact("transactions", "search", "status", "lastRecord", "marker"));
    }

    /**
     * employerFiledReturns
     *
     * @return void
     */
    public function employerFiledReturns()
    {
        $search = request()->search;
        $status = request()->status;

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord   = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 2)->where("reference", $search)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 2)->where("reference", $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord   = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 2)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 2)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord   = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 2)->where("reference", $search)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Returns::query()->where("user_id", Auth::user()->id)->where("self_filed", 2)->where("reference", $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = Returns::where("user_id", Auth::user()->id)->where("self_filed", 2)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Returns::where("user_id", Auth::user()->id)->where("self_filed", 2)->paginate(50);
        }

        return view("individual.employer_filed_returns", compact("transactions", "search", "status", "lastRecord", "marker"));
    }

    /**
     * fileReturns
     *
     * @return void
     */
    public function fileReturns()
    {
        return view("individual.file_returns");
    }

    /**
     * initiateReturnsFiling
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateReturnsFiling(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_period'      => 'required',
            'salary'              => 'required|numeric',
            'allowances'          => 'required|numeric',
            'commissions'         => 'required|numeric',
            'trades'              => 'required|numeric',
            'consolidated_income' => 'required|numeric',
            'financial_statement' => 'required|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $alreadyFiled = Returns::where("tax_payer_id", Auth::user()->taxpayer->id)->where("period", $request->payment_period)->first();
        if (isset($alreadyFiled)) {
            toast("Returns Already Filed For The Specified Period", 'error');
            return back();
        }

        $totalIncome = (double) ($request->salary + $request->allowances + $request->commissions + $request->trades + $request->consolidated_income);
        try {
            DB::beginTransaction();

            $return               = new Returns;
            $return->user_id      = Auth::user()->id;
            $return->tax_payer_id = Auth::user()->taxpayer->id;
            $return->category     = "individual";
            $return->period       = $request->payment_period;
            $return->narration    = "Personal Income Tax For Year " . $request->payment_period;
            $return->income       = $totalIncome;
            $return->save();

            $incomeSource                      = new IncomeSource;
            $incomeSource->returns_id          = $return->id;
            $incomeSource->salary              = $request->salary;
            $incomeSource->allowances          = $request->allowances;
            $incomeSource->commissions         = $request->commissions;
            $incomeSource->trade               = $request->trades;
            $incomeSource->consolidated_income = $request->consolidated_income;
            $incomeSource->total               = $totalIncome;
            $incomeSource->save();

            if ($request->has('financial_statement')) {

                $document                 = new UploadedDocuments;
                $document->returns_id     = $return->id;
                $document->document_type  = "financial statement";
                $document->document_title = "Financial Statement";
                $financialStatement       = Cloudinary::upload($request->file('financial_statement')->getRealPath())->getSecurePath();
                $document->document       = $financialStatement;
                $document->save();
            }

            DB::commit();

            return redirect()->route("individual.previousReturns", [$return->reference]);
        } catch (\Throwable $e) {
            DB::rollback();

            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * previousReturns
     *
     * @param mixed reference
     *
     * @return void
     */
    public function previousReturns($reference)
    {
        $return = Returns::where("reference", $reference)->first();

        $previousYears = self::getPreviousYears($return->period);

        $previousReturns = Returns::where("tax_payer_id", $return->tax_payer_id)->whereIn("period", $previousYears)->where("status", "paid")->get();

        $missedReturns = self::getMissedReturns($return->tax_payer_id, $return->period);
        $missedYears   = self::getMissedYears($return->tax_payer_id, $return->id, $return->period);

        $uploadedDocuments = UploadedDocuments::orderBy("period", "asc")->where("returns_id", $return->id)->where("document_type", "previous filing")->get();

        if (count($previousReturns) < 3) {
            return view("individual.previous_filed_returns", compact("return", "previousReturns", "missedReturns", "missedYears", "uploadedDocuments"));
        }

        return redirect()->rouute("individual.previewApplication", [$reference]);

    }

    /**
     * uploadPreviousReturns
     *
     * @param Request request
     *
     * @return void
     */
    public function uploadPreviousReturns(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'return_id'       => 'required',
            'period'          => 'required',
            'income_declared' => 'required|numeric',
            'tax_paid'        => 'required|numeric',
            'tax_clearance'   => 'required|file',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        if ($request->has('tax_clearance')) {

            $document                 = new UploadedDocuments;
            $document->returns_id     = $request->return_id;
            $document->period         = $request->period;
            $document->document_type  = "previous filing";
            $document->document_title = "Indication of Filed Return For Year " . $request->period;
            $document->income         = $request->income_declared;
            $document->tax_paid       = $request->tax_paid;
            $uploadedDocument         = Cloudinary::upload($request->file('tax_clearance')->getRealPath())->getSecurePath();
            $document->document       = $uploadedDocument;
            $document->save();

            toast("Document Uploaded Successfully", 'success');
            return back();
        }
        return back();

    }

    /**
     * previewApplication
     *
     * @param mixed reference
     *
     * @return void
     */
    public function previewApplication($reference)
    {
        $return = Returns::where("reference", $reference)->first();

        $income = IncomeSource::where("returns_id", $return->id)->first();

        $previousYears = self::getPreviousYears($return->period);

        $previousReturns = Returns::where("tax_payer_id", $return->tax_payer_id)->whereIn("period", $previousYears)->where("status", "paid")->get();

        $uploadedDocuments = UploadedDocuments::orderBy("period", "asc")->where("returns_id", $return->id)->where("document_type", "previous filing")->get();

        return view("individual.preview_return_application", compact("return", "income", "previousReturns", "uploadedDocuments"));

    }

    /**
     * submitReturnApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function submitReturnApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'return_id'   => 'required',
            'declaration' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            DB::beginTransaction();

            $return         = Returns::find($request->return_id);
            $return->status = "awaiting assessment";
            $return->save();

            $assessment               = new Assessments;
            $assessment->returns_id   = $return->id;
            $assessment->user_id      = $return->user_id;
            $assessment->tax_payer_id = $return->tax_payer_id;
            $assessment->save();

            DB::commit();

            toast("Returns Submitted And Awaiting Assessment", 'success');
            return redirect()->route("individual.filedReturns");

        } catch (\Throwable $e) {
            DB::rollback();
            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * returnDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function returnDetails($reference)
    {
        $return     = Returns::find($reference);
        $assessment = Assessments::where("returns_id", $request->return_id)->first();
        return view("individual.returns_details", compact("return", "assessment"));
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

    /**
     * getFee
     *
     * @param mixed id
     * @param mixed amount
     *
     * @return void
     */
    public static function getFee($id)
    {
        $item = PaymentItem::find($id);
        $fee  = ((env("BDIC_FEE_PERCENT") / 100) * $item->amount);
        return $fee;

    }

    /**
     * getPreviousYears
     *
     * @param mixed year
     * @param mixed count
     *
     * @return void
     */
    public function getPreviousYears($year, $count = 3)
    {
        $years = [];
        for ($i = $count; $i >= 1; $i--) {
            $years[] = $year - $i;
        }
        return $years;
    }

    /**
     * getMissedYears
     *
     * @param mixed table
     * @param mixed yearColumn
     * @param mixed currentYear
     * @param mixed count
     *
     * @return void
     */
    public function getMissedReturns($taxPayer, $year, $count = 3)
    {
        $missedYears   = [];
        $previousYears = [];
        for ($i = $count; $i >= 1; $i--) {
            $previousYears[] = $year - $i;
        }

        foreach ($previousYears as $year) {
            $exists = Returns::where("tax_payer_id", $taxPayer)->where("period", $year)->where("status", "paid")->exists();

            if (! $exists) {
                $missedYears[] = $year;
            }
        }

        if (count($missedYears) > 1) {
            $lastYear      = array_pop($missedYears);
            $missedReturns = implode(", ", $missedYears) . " and " . $lastYear;
        } else {
            $missedReturns = $missedYears[0];
        }

        return $missedReturns;

    }

    /**
     * getMissedYears
     *
     * @param mixed taxPayer
     * @param mixed year
     * @param mixed count
     *
     * @return void
     */
    public function getMissedYears($taxPayer, $return, $year, $count = 3)
    {
        $missedYears   = [];
        $previousYears = [];
        for ($i = $count; $i >= 1; $i--) {
            $previousYears[] = $year - $i;
        }

        foreach ($previousYears as $year) {
            $exists = Returns::where("tax_payer_id", $taxPayer)->where("period", $year)->exists();

            if (! $exists) {
                $missedYears[] = $year;
            }
        }

        $uploadedDocuments = UploadedDocuments::where("returns_id", $return)->where("document_type", "previous filing")->pluck("period")->toArray();

        $filteredYears = array_diff($missedYears, $uploadedDocuments);

        $filteredYears = array_values($filteredYears);

        return $filteredYears;

    }
}
