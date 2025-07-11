<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\AwardLetter;
use App\Models\BusinessCategories;
use App\Models\CompanyPayments;
use App\Models\CompanyRenewals;
use App\Models\Mda;
use App\Models\PaymentItem;
use App\Models\PowerOfAttorney;
use App\Models\ProcessingFee;
use App\Models\User;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Session;

class BusinessController extends Controller
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
            return view("business.dashboard");
        } else {
            return redirect()->route("business.viewProfile");
        }
    }

    /**
     * profile
     *
     * @return void
     */
    public function viewProfile()
    {
        return view("business.profile");
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
            'last_name'       => 'required',
            'other_names'     => 'required',
            'phone_number'    => 'required',
            'gender'          => 'required',
            'nationality'     => 'required',
            'marital_status'  => 'required',
            'dob'             => 'required',
            'contact_address' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $state = Auth::user()->profile_updated;

        $parseEmail = User::where("email", $request->email)->where("id", "!=", Auth::user()->id)->count();
        if ($parseEmail > 0) {
            toast('Email already used by someone else.', 'error');
            return back();
        }

        $parsePhone = User::where("email", $request->phone_number)->where("id", "!=", Auth::user()->id)->count();
        if ($parsePhone > 0) {
            toast('Phone number already used by someone else.', 'error');
            return back();
        }

        $user                  = Auth::user();
        $user->last_name       = $request->last_name;
        $user->other_names     = $request->other_names;
        $user->phone_number    = $request->phone_number;
        $user->gender          = $request->gender;
        $user->nationality     = $request->nationality;
        $user->dob             = $request->dob;
        $user->marital_status  = $request->marital_status;
        $user->contact_address = $request->contact_address;
        $user->profile_updated = 1;
        if ($request->has('profile_photo')) {
            $uploadedFileUrl     = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
            $user->profile_photo = $uploadedFileUrl;
        }

        if ($user->save()) {
            if ($state == 1) {
                toast('Profile Information Successfully Updated.', 'success');
                return back();
            } else {
                toast('Profile Information Successfully Updated.', 'success');
                return redirect()->route("business.dashboard");
            }

        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }

    }

    /**
     * changePassword
     *
     * @return void
     */
    public function changePassword()
    {
        return view("business.change_password");
    }

    /**
     * updatePassword
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password'          => 'required',
            'new_password'              => 'required',
            'new_password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            toast('Invalid current password provided.', 'error');
            return back();
        } else {
            if ($request->new_password != $request->new_password_confirmation) {
                toast('Your newly seleted passwords do not match.', 'error');
                return back();
            } else {
                $user->password = Hash::make($request->new_password);
                $user->save();
            }
        }

        if ($user->save()) {
            toast('Password Successfully Updated.', 'success');
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
        return view("business.security", compact("google2faSecret", "QRImage"));
    }

    /**
     * enableGA
     *
     * @param Request request
     *
     * @return void
     */
    public function enableGA(Request $request)
    {
        $gaCode   = $request->google2fa_code;
        $gaSecret = $request->google2fa_secret;

        if ($gaCode == null || $gaSecret == null) {
            toast('Please enter a valid Google 2FA Code.', 'error');
            return back();
        }

        $user      = Auth::user();
        $google2fa = app('pragmarx.google2fa');
        $valid     = $google2fa->verifyKey($gaSecret, $gaCode);

        if ($valid) {
            $user->google2fa_secret = $gaSecret;
            if ($user->save()) {
                toast('Successfully Enabled Google Authenticator on your account', 'success');
                return back();
            } else {
                toast('Something went wrong.', 'error');
                return back();
            }

        } else {
            toast('Invalid Google 2FA Code.', 'error');
            return back();

        }

    }

    /**
     * select2FA
     *
     * @param Request request
     *
     * @return void
     */
    public function select2FA(Request $request)
    {

        $user = Auth::user();

        if ($request->param == "google_auth2fa") {
            if (isset($user->google2fa_secret) && $request->status == 1) {
                $data = [
                    'id'   => Auth::user()->id,
                    'time' => now(),
                ];
                Session::put('myGoogle2fa', $data);
                $user->auth_2fa = "GoogleAuth";
            } else if (isset($user->google2fa_secret) && $request->status == 0) {
                $user->auth_2fa = null;
                Session::forget('myGoogle2fa');
            } else {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Please Setup Google Authenticator to be able to enable this option.',
                ]);
            }
        }

        if ($request->param == "email_auth2fa") {
            if ($request->status == 1) {
                $user->auth_2fa = "Email";
                $data           = [
                    'id'   => Auth::user()->id,
                    'time' => now(),
                ];
                Session::put('myValid2fa', $data);
            } else {
                $user->auth_2fa = null;
                Session::forget('myValid2fa');
            }
        }

        if ($user->save()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Authentication 2FA Method Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong! Please try again',
            ]);
        }

    }

    /**
     * companyRegistration
     *
     * @return void
     */
    public function companyRegistration()
    {
        $formPurchase = CompanyPayments::where("user_id", Auth::user()->id)->where("payment_item_id", 5)->where("status", "paid")->first();
        if (isset($formPurchase)) {
            $paidRegFee = CompanyPayments::where("user_id", Auth::user()->id)->where("payment_item_id", 6)->where("status", "paid")->first();
            if (isset($paidRegFee)) {
                return view("business.registration_details");
            } else {
                $bizCategories = BusinessCategories::where("status", "active")->get();
                return view("business.application_form", compact("bizCategories"));
            }
        } else {
            $payment = PaymentItem::find(5);
            return view("business.purchase_form", compact("payment"));
        }
    }

    /**
     * companyRenewals
     *
     * @return void
     */
    public function companyRenewals()
    {
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = CompanyRenewals::query()->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = CompanyRenewals::query()->where("company_id", Auth::user()->company->id)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = CompanyRenewals::query()->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = CompanyRenewals::where("company_id", Auth::user()->company->id)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = CompanyRenewals::orderBy("id", "desc")->where('company_id', Auth::user()->company->id)->paginate(50);
        }
        return view("business.company_renewals", compact("transactions", "search", "status", "lastRecord", "marker"));
    }

    /**
     * initiateCompanyRenewal
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateCompanyRenewal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'registration_number' => 'required',
            'period'              => 'required',
            'company_email'       => 'required',
            'phone_number'        => 'required',
            'expiry_date'         => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $reference = $this->genTrxReference();

            $item = PaymentItem::find(1);

            DB::beginTransaction();

            $trx                   = new CompanyRenewals;
            $trx->reference_number = $reference;
            $trx->company_id       = Auth::user()->company->id;
            $trx->company_name     = Auth::user()->company->company_name;
            $trx->company_address  = Auth::user()->company->company_address;
            $trx->bsppc_number     = $request->registration_number;
            $trx->expiry_date      = $request->expiry_date;
            $trx->phone_number     = $request->phone_number;
            $trx->email            = $request->company_email;
            $trx->period           = $request->period;
            $trx->amount_paid      = ($item->amount * $request->period);
            $trx->save();

            $fee = $this->getFee($item->id, $trx->amount_paid);

            $paymentLog                   = new CompanyPayments;
            $paymentLog->user_id          = Auth::user()->id;
            $paymentLog->company_id       = $trx->company_id;
            $paymentLog->payment_item_id  = $item->id;
            $paymentLog->reference_number = $trx->reference_number;
            $paymentLog->amount_paid      = $trx->amount_paid;
            $paymentLog->fee_charged      = $fee;
            $paymentLog->total            = ($trx->amount_paid + $fee);
            $paymentLog->save();

            DB::commit();
            return redirect()->route("business.companyRenewalPreview", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    /**
     * companyRenewalPreview
     *
     * @param mixed reference
     *
     * @return void
     */
    public function companyRenewalPreview($reference)
    {
        $trx     = CompanyRenewals::where("reference_number", $reference)->first();
        $payment = CompanyPayments::where("reference_number", $reference)->first();
        return view("business.company_renewal_preview", compact("trx", "payment"));
    }

    /**
     * companyRenewalDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function companyRenewalDetails($reference)
    {
        $trx = CompanyRenewals::where("reference_number", $reference)->first();
        return view("business.company_renewal_details", compact("trx"));
    }

    /**
     * powerOfAttorney
     *
     * @return void
     */
    public function powerOfAttorney()
    {
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = PowerOfAttorney::query()->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = PowerOfAttorney::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = PowerOfAttorney::query()->where("company_id", Auth::user()->company->id)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = PowerOfAttorney::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = PowerOfAttorney::query()->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = PowerOfAttorney::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = PowerOfAttorney::where("company_id", Auth::user()->company->id)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = PowerOfAttorney::orderBy("id", "desc")->where('company_id', Auth::user()->company->id)->paginate(50);
        }

        $mdas = Mda::all();
        return view("business.poa", compact("transactions", "search", "status", "lastRecord", "marker", "mdas"));
    }

    /**
     * initiatePOAApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function initiatePOAApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donor_company'     => 'required',
            'contract_name'     => 'required',
            'contract_sum'      => 'required',
            'date_of_award'     => 'required',
            'date_of_poa'       => 'required',
            'contract_duration' => 'required',
            'mda'               => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $reference = $this->genTrxReference();

            $item = PaymentItem::find(2);

            DB::beginTransaction();

            $trx                    = new PowerOfAttorney;
            $trx->reference_number  = $reference;
            $trx->company_id        = Auth::user()->company->id;
            $trx->donor_company     = $request->donor_company;
            $trx->contract_name     = $request->contract_name;
            $trx->contract_amount   = $request->contract_sum;
            $trx->award_date        = $request->date_of_award;
            $trx->poa_date          = $request->date_of_poa;
            $trx->contract_duration = $request->contract_duration;
            $trx->mda               = $request->mda;
            $trx->amount_paid       = $item->amount;
            $trx->save();

            $fee = $this->getFee($item->id, $trx->amount_paid);

            $paymentLog                   = new CompanyPayments;
            $paymentLog->user_id          = Auth::user()->id;
            $paymentLog->company_id       = $trx->company_id;
            $paymentLog->payment_item_id  = $item->id;
            $paymentLog->reference_number = $trx->reference_number;
            $paymentLog->amount_paid      = $trx->amount_paid;
            $paymentLog->fee_charged      = $fee;
            $paymentLog->total            = ($trx->amount_paid + $fee);
            $paymentLog->save();

            DB::commit();
            return redirect()->route("business.powerOfAttorneyPreview", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    /**
     * powerOfAttorneyPreview
     *
     * @param mixed reference
     *
     * @return void
     */
    public function powerOfAttorneyPreview($reference)
    {
        $trx     = PowerOfAttorney::where("reference_number", $reference)->first();
        $payment = CompanyPayments::where("reference_number", $reference)->first();
        return view("business.poa_preview", compact("trx", "payment"));
    }

    /**
     * powerOfAttorneyDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function powerOfAttorneyDetails($reference)
    {
        $trx = PowerOfAttorney::where("reference_number", $reference)->first();
        return view("business.poa_details", compact("trx"));
    }

    /**
     * processingFees
     *
     * @return void
     */
    public function processingFees()
    {
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = ProcessingFee::query()->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = ProcessingFee::query()->where("company_id", Auth::user()->company->id)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = ProcessingFee::query()->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = ProcessingFee::where("company_id", Auth::user()->company->id)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = ProcessingFee::orderBy("id", "desc")->where('company_id', Auth::user()->company->id)->paginate(50);
        }

        $mdas = Mda::all();
        return view("business.processing_fees", compact("transactions", "search", "status", "lastRecord", "marker", "mdas"));
    }

    /**
     * initiatePRFRemittance
     *
     * @param Request request
     *
     * @return void
     */
    public function initiatePRFRemittance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contract_name'     => 'required',
            'contract_sum'      => 'required',
            'date_of_award'     => 'required',
            'contract_duration' => 'required',
            'mda'               => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $reference = $this->genTrxReference();

            $item = PaymentItem::find(4);

            DB::beginTransaction();

            $trx                    = new ProcessingFee;
            $trx->reference_number  = $reference;
            $trx->company_id        = Auth::user()->company->id;
            $trx->company_name      = Auth::user()->company->company_name;
            $trx->contract_name     = $request->contract_name;
            $trx->contract_amount   = $request->contract_sum;
            $trx->award_date        = $request->date_of_award;
            $trx->contract_duration = $request->contract_duration;
            $trx->mda               = $request->mda;
            $trx->amount_paid       = ((1 / 100) * $request->contract_sum);
            $trx->save();

            $fee = $this->getFee($item->id, $trx->amount_paid);

            $paymentLog                   = new CompanyPayments;
            $paymentLog->user_id          = Auth::user()->id;
            $paymentLog->company_id       = $trx->company_id;
            $paymentLog->payment_item_id  = $item->id;
            $paymentLog->reference_number = $trx->reference_number;
            $paymentLog->amount_paid      = $trx->amount_paid;
            $paymentLog->fee_charged      = $fee;
            $paymentLog->total            = ($trx->amount_paid + $fee);
            $paymentLog->save();

            DB::commit();
            return redirect()->route("business.processingFeesPreview", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    /**
     * processingFeesPreview
     *
     * @param mixed reference
     *
     * @return void
     */
    public function processingFeesPreview($reference)
    {
        $trx     = ProcessingFee::where("reference_number", $reference)->first();
        $payment = CompanyPayments::where("reference_number", $reference)->first();
        return view("business.processing_fees_preview", compact("trx", "payment"));
    }

    /**
     * processingFeesDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function processingFeesDetails($reference)
    {
        $trx = ProcessingFee::where("reference_number", $reference)->first();
        return view("business.processing_fees_details", compact("trx"));
    }

    /**
     * awardLetters
     *
     * @return void
     */
    public function awardLetters()
    {
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = AwardLetter::query()->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = AwardLetter::query()->where("company_id", Auth::user()->company->id)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = AwardLetter::query()->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->orderBy("id", "desc")->where("company_id", Auth::user()->company->id)->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = AwardLetter::where("company_id", Auth::user()->company->id)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = AwardLetter::orderBy("id", "desc")->where('company_id', Auth::user()->company->id)->paginate(50);
        }

        $mdas = Mda::all();
        return view("business.award_letters", compact("transactions", "search", "status", "lastRecord", "marker", "mdas"));
    }

    /**
     * initiateAwardLetterRequest
     *
     * @param Request request
     *
     * @return void
     */
    public function initiateAwardLetterRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contract_name'     => 'required',
            'contract_sum'      => 'required',
            'date_of_award'     => 'required',
            'contract_duration' => 'required',
            'mda'               => 'required',
            'tcc'               => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $reference = $this->genTrxReference();

            $item = PaymentItem::find(3);

            DB::beginTransaction();

            $trx                    = new AwardLetter;
            $trx->reference_number  = $reference;
            $trx->company_id        = Auth::user()->company->id;
            $trx->company_name      = Auth::user()->company->company_name;
            $trx->contract_name     = $request->contract_name;
            $trx->contract_amount   = $request->contract_sum;
            $trx->award_date        = $request->date_of_award;
            $trx->contract_duration = $request->contract_duration;
            $trx->mda               = $request->mda;
            $trx->amount_paid       = $item->amount;
            if ($request->has('tcc')) {
                $uploadedFileUrl = Cloudinary::upload($request->file('tcc')->getRealPath())->getSecurePath();
                $trx->tcc_cert   = $uploadedFileUrl;
            }
            $trx->save();

            $fee = $this->getFee($item->id, $trx->amount_paid);

            $paymentLog                   = new CompanyPayments;
            $paymentLog->user_id          = Auth::user()->id;
            $paymentLog->company_id       = $trx->company_id;
            $paymentLog->payment_item_id  = $item->id;
            $paymentLog->reference_number = $trx->reference_number;
            $paymentLog->amount_paid      = $trx->amount_paid;
            $paymentLog->fee_charged      = $fee;
            $paymentLog->total            = ($trx->amount_paid + $fee);
            $paymentLog->save();

            DB::commit();
            return redirect()->route("business.awardLettersPreview", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    /**
     * awardLettersPreview
     *
     * @param mixed reference
     *
     * @return void
     */
    public function awardLettersPreview($reference)
    {
        $trx     = AwardLetter::where("reference_number", $reference)->first();
        $payment = CompanyPayments::where("reference_number", $reference)->first();
        return view("business.award_letters_preview", compact("trx", "payment"));
    }

    /**
     * awardLettersDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function awardLettersDetails($reference)
    {
        $trx = AwardLetter::where("reference_number", $reference)->first();
        return view("business.award_letters_details", compact("trx"));
    }

    /**
     * processPayment
     *
     * @param Request reference
     *
     * @return void
     */
    public function processPayment(Request $request)
    {
        $validatedData = $request->validate([
            'reference' => 'required',
        ]);

        $email       = null;
        $callbackUrl = null;
        $trx         = null;

        $payment = CompanyPayments::where("reference_number", $request->reference)->first();

        if ($payment->payment_item_id == 1) {
            $trx         = CompanyRenewals::where("reference_number", $request->reference)->first();
            $email       = Auth::user()->email;
            $callbackUrl = route("etranzact.renewal.callBack");
            $narration   = "Company Registration Renewal";
        } else if ($payment->payment_item_id == 2) {
            $email       = Auth::user()->email;
            $callbackUrl = route("etranzact.poa.callBack");
            $trx         = PowerOfAttorney::where("reference_number", $request->reference)->first();
            $narration   = "Power Of Attorney Application";
        } else if ($payment->payment_item_id == 3) {
            $email       = Auth::user()->email;
            $callbackUrl = route("etranzact.award.callBack");
            $trx         = AwardLetter::where("reference_number", $request->reference)->first();
            $narration   = "Award Letter Application";
        } else if ($payment->payment_item_id == 4) {
            $email       = Auth::user()->email;
            $callbackUrl = route("etranzact.prf.callBack");
            $trx         = ProcessingFee::where("reference_number", $request->reference)->first();
            $narration   = "Processing Fee Remittance";
        }

        try {
            $response = Http::accept('application/json')->withHeaders([
                'authorization' => env('CREDO_PUBLIC_KEY'),
                'content_type'  => "Content-Type: application/json",
            ])->post(env("CREDO_URL") . "/transaction/initialize", [
                "email"       => $email,
                "amount"      => ($payment->total * 100),
                "reference"   => str_replace("BSPPC-", "", $request->reference),
                "narration"   => $narration,
                "callbackUrl" => $callbackUrl,
                "bearer"      => 0,
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
     * purchaseRegForm
     *
     * @param Request request
     *
     * @return void
     */
    public function purchaseRegForm(Request $request)
    {

        $item = PaymentItem::find(5);
        $fee  = $this->getFee($item->id, $item->amount);

        $paymentLog                   = new CompanyPayments;
        $paymentLog->user_id          = Auth::user()->id;
        $paymentLog->payment_item_id  = $item->id;
        $paymentLog->reference_number = $this->genTrxReference();
        $paymentLog->amount_paid      = $item->amount;
        $paymentLog->fee_charged      = $fee;
        $paymentLog->total            = ($item->amount + $fee);
        if ($paymentLog->save()) {

            try {
                $response = Http::accept('application/json')->withHeaders([
                    'authorization' => env('CREDO_PUBLIC_KEY'),
                    'content_type'  => "Content-Type: application/json",
                ])->post(env("CREDO_URL") . "/transaction/initialize", [
                    "email"       => Auth::user()->email,
                    "amount"      => ($paymentLog->total * 100),
                    "reference"   => str_replace("BSPPC-", "", $paymentLog->reference_number),
                    "narration"   => "Company Registration Form Purchase",
                    "callbackUrl" => route("etranzact.regform.callBack"),
                    "bearer"      => 0,
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
        } else {
            toast('Something Went Wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * genTrxReference
     *
     * @return void
     */
    public function genTrxReference()
    {
        $uuid      = Str::uuid()->toString();
        $hash      = substr(abs(crc32($uuid)), 0, 3); // 32-bit numeric hash
        $timestamp = strtotime(now());                // Add timestamp for more uniqueness
        $random    = Auth::user()->id . "" . Auth::user()->company->id;

        $reference = 'BSPPC-' . $random . $timestamp . $hash;

        return $reference;
    }

    /**
     * getFee
     *
     * @param mixed id
     * @param mixed amount
     *
     * @return void
     */
    public function getFee($id, $amount)
    {
        $item = PaymentItem::find($id);
        if ($item->fee_config == "percentage") {
            $fee = (($item->fee / 100) * $amount);
            return $fee;
        } else {
            return $item->fee;
        }

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
