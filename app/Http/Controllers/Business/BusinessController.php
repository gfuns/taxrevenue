<?php
namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\AwardLetter;
use App\Models\BusinessCategories;
use App\Models\Company;
use App\Models\CompanyDocuments;
use App\Models\CompanyPayments;
use App\Models\CompanyProjects;
use App\Models\CompanyRenewals;
use App\Models\Mda;
use App\Models\PaymentItem;
use App\Models\PowerOfAttorney;
use App\Models\ProcessingFee;
use App\Models\UploadableDocs;
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
        $company = Company::where("user_id", Auth::user()->id)->first();
        if (isset($company) && ! empty($company)) {
            if ($company->status != "in progress") {
                $documents        = CompanyDocuments::where("company_id", $company->id)->get();
                $executedProjects = CompanyProjects::where("company_id", $company->id)->get();
                if ($company->status == "rejected") {
                    $bizCategories  = BusinessCategories::where("status", "active")->get();
                    $uploadableDocs = UploadableDocs::where("category", "registration")->get();
                    return view("business.update_registration_details", compact("company", "documents", "executedProjects", "bizCategories", "uploadableDocs"));
                } else {
                    return view("business.registration_details", compact("company", "documents", "executedProjects"));
                }
            } else {
                $payment = PaymentItem::find(6);
                return view("business.resume_application", compact("company", "payment"));
            }
        } else {
            $formPurchase = CompanyPayments::where("user_id", Auth::user()->id)->where("payment_item_id", 5)->where("status", "payment successful")->first();
            if (isset($formPurchase) && ! empty($formPurchase)) {
                $bizCategories = BusinessCategories::where("status", "active")->get();
                $formRef       = $formPurchase->reference_number;
                $regType       = "Registration";
                return view("business.application_form", compact("bizCategories", "regType", 'formRef'));
            } else {
                $payment = PaymentItem::find(5);
                return view("business.purchase_form", compact("payment"));
            }
        }
    }

    /**
     * resumeApplication
     *
     * @param mixed id
     *
     * @return void
     */
    public function resumeApplication($id)
    {
        $company = Company::find($id);
        if (isset($company) && ! empty($company)) {
            if ($company->application_stage == "payment") {
                $item = PaymentItem::find(6);
                $fee  = $this->getFee($item->id, $item->amount);

                $paymentLog                   = new CompanyPayments;
                $paymentLog->user_id          = Auth::user()->id;
                $paymentLog->company_id       = $company->id;
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
                            "narration"   => "Company Registration Application Fee",
                            "callbackUrl" => route("etranzact.regfee.callBack"),
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
            } else if ($company->application_stage == "projects") {
                return redirect()->route("business.pastProjects", [$company->id]);
            } else {
                return redirect()->route("business.companyDocuments", [$company->id]);
            }
        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    /**
     * accountRevalidation
     *
     * @return void
     */
    public function accountRevalidation()
    {
        $bizCategories = BusinessCategories::where("status", "active")->get();
        $regType       = "Revalidation";
        $formRef       = null;
        return view("business.application_form", compact("bizCategories", "regType", "formRef"));
    }

    /**
     * submitApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function submitApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_type'     => 'required',
            'bsppc_number'         => 'required_if:application_type,revalidation',
            'cac_number'           => 'required',
            'company_name'         => 'required',
            'company_adress'       => 'required',
            'categories'           => 'required|array|min:1|max:2',
            'categories.*'         => 'exists:business_categories,id',
            'prev_registered'      => 'required',
            'prev_class'           => 'required_if:prev_registered,yes',
            'prev_location'        => 'required_if:prev_registered,yes',
            'prev_works'           => 'required_if:prev_registered,yes',
            'prev_period'          => 'required_if:prev_registered,yes',
            'prev_reg_number'      => 'required_if:prev_registered,yes',
            'certificate_validity' => 'required_if:prev_registered,yes',
            'invalidity_reason'    => 'required_if:prev_registered,no',
            'business_experience'  => 'required',
            'experience_details'   => 'required_if:business_experience,yes',
            'business_capital'     => 'required',
            'bank_exist'           => 'required',
            'bank_name'            => 'required_if:bank_exist,yes',
            'bank_branch'          => 'required_if:bank_exist,yes',
            'account_number'       => 'required_if:bank_exist,yes',
            'postal_address'       => 'required_if:bank_exist,yes',
            'upgrading'            => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $bizCategories                    = implode(', ', $request->input('categories', []));
        $payment                          = PaymentItem::find(6);
        $company                          = new Company;
        $company->user_id                 = Auth::user()->id;
        $company->application_type        = $request->application_type;
        $company->bsppc_number            = $request->bsppc_number;
        $company->cac_number              = $request->cac_number;
        $company->company_name            = $request->company_name;
        $company->company_address         = $request->company_adress;
        $company->business_category       = $bizCategories;
        $company->classification          = "F";
        $company->prev_reg                = $request->prev_registered;
        $company->prev_reg_class          = $request->prev_class;
        $company->prev_reg_where          = $request->prev_location;
        $company->prev_reg_works          = $request->prev_works;
        $company->prev_reg_when           = $request->prev_period;
        $company->prev_reg_no             = $request->prev_reg_number;
        $company->prev_reg_valid          = $request->certificate_validity;
        $company->prev_reg_invalid_reason = $request->invalidity_reason;
        $company->business_experience     = $request->business_experience;
        $company->experience_details      = $request->experience_details;
        $company->business_capital        = $request->business_capital;
        $company->operate_bank            = $request->bank_exist;
        $company->bank_name               = $request->bank_name;
        $company->bank_branch             = $request->bank_branch;
        $company->account_number          = $request->account_number;
        $company->bank_postal_address     = $request->postal_address;
        $company->upgrade_application     = $request->upgrading;
        $company->form_reference_number   = $request->form_reference;
        $company->amount_paid             = $payment->amount;
        if ($company->save()) {
            if ($company->upgrade_application == "yes") {
                $company->application_stage = "projects";
                $company->save();
                return redirect()->route("business.pastProjects", [$company->id]);
            } else {
                $company->application_stage = "documents";
                $company->save();
                return redirect()->route("business.companyDocuments", [$company->id]);
            }
        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    /**
     * updateRegDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function updateRegDetails(Request $request)
    {

    }

    /**
     * pastProjects
     *
     * @param mixed id
     *
     * @return void
     */
    public function pastProjects($id)
    {
        $company = Company::find($id);
        if (isset($company) || ! empty($company)) {
            $executedProjects = CompanyProjects::where("company_id", $company->id)->get();
            return view("business.executed_projects", compact("company", "executedProjects"));
        } else {
            return redirect()->route("business.companyRegistration");
        }
    }

    /**
     * addProject
     *
     * @param Request request
     *
     * @return void
     */
    public function addProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id'           => 'required',
            'awarding_body'        => 'required',
            'contract_description' => 'required',
            'contract_amount'      => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $project                       = new CompanyProjects;
        $project->company_id           = $request->company_id;
        $project->awarding_body        = $request->awarding_body;
        $project->contract_description = $request->contract_description;
        $project->amount               = $request->contract_amount;
        if ($project->save()) {
            toast('Project Captured Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    /**
     * removeProject
     *
     * @param mixed id
     *
     * @return void
     */
    public function removeProject($id)
    {
        $project = CompanyProjects::find($id);
        if ($project->delete()) {
            toast('Project Removed Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    /**
     * companyDocuments
     *
     * @param mixed id
     *
     * @return void
     */
    public function companyDocuments($id)
    {
        $company = Company::find($id);
        if (isset($company) || ! empty($company)) {
            $company->application_stage = "documents";
            $company->save();

            $documents      = CompanyDocuments::where("company_id", $company->id)->get();
            $uploadableDocs = UploadableDocs::where("category", "registration")->get();
            return view("business.company_documents", compact("company", "documents", "uploadableDocs"));
        } else {
            return redirect()->route("business.companyRegistration");
        }
    }

    /**
     * uploadDocument
     *
     * @param Request request
     *
     * @return void
     */
    public function uploadDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id'     => 'required',
            'document_title' => 'required',
            'document'       => 'required|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $doc              = new CompanyDocuments;
        $doc->company_id  = $request->company_id;
        $doc->document_id = $request->document_title;
        $doc->document    = $request->document;
        if ($request->has('document')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('document')->getRealPath())->getSecurePath();
            $doc->document   = $uploadedFileUrl;
        }
        if ($doc->save()) {
            toast('Document Uploaded Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    /**
     * removeDocument
     *
     * @param mixed id
     *
     * @return void
     */
    public function removeDocument($id)
    {
        $doc = CompanyDocuments::find($id);
        if ($doc->delete()) {
            toast('Document Removed Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong.', 'error');
            return back();
        }
    }

    /**
     * previewApplication
     *
     * @param mixed id
     *
     * @return void
     */
    public function previewApplication($id)
    {
        $company = Company::find($id);
        if (isset($company) || ! empty($company)) {
            $company->application_stage = "payment";
            $company->save();

            $documents        = CompanyDocuments::where("company_id", $company->id)->get();
            $executedProjects = CompanyProjects::where("company_id", $company->id)->get();
            return view("business.application_preview", compact("company", "documents", "executedProjects"));
        } else {
            return redirect()->route("business.companyRegistration");
        }
    }

    /**
     * finalizeApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function finalizeApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $company                    = Company::find($request->company_id);
        $company->status            = $company->application_type == "registration" ? "in progress" : "awaiting approval";
        $company->application_stage = $company->application_type == "registration" ? "payment" : "complete";
        if ($company->save()) {

            if ($company->application_type == "registration") {
                $item = PaymentItem::find(6);
                $fee  = $this->getFee($item->id, $item->amount);

                $paymentLog                   = new CompanyPayments;
                $paymentLog->user_id          = Auth::user()->id;
                $paymentLog->company_id       = $company->id;
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
                            "narration"   => "Company Registration Application Fee",
                            "callbackUrl" => route("etranzact.regfee.callBack"),
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

            toast('Application Submitted Successfully And Awaiting Approval.', 'success');
            return redirect()->route("business.dashboard");

        } else {
            return redirect()->route("business.companyRegistration");
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
            'bsppc_certificate'   => 'required|file|mimes:pdf',
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
            if ($request->has('bsppc_certificate')) {
                $uploadedFileUrl = Cloudinary::upload($request->file('bsppc_certificate')->getRealPath())->getSecurePath();
                $trx->bsppc_cert = $uploadedFileUrl;
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
            return redirect()->route("business.companyRenewalPreview", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    /**
     * editRenewalApplication
     *
     * @param mixed reference
     *
     * @return void
     */
    public function editRenewalApplication($reference)
    {
        $trx = CompanyRenewals::where("reference_number", $reference)->first();
        return view("business.update_renewals", compact("trx"));
    }

    /**
     * updateRenewalApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function updateRenewalApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'      => 'required',
            'registration_number' => 'required',
            'company_email'       => 'required',
            'phone_number'        => 'required',
            'expiry_date'         => 'required',
            'bsppc_certificate'   => 'nullable|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {

            $trx               = CompanyRenewals::find($request->application_id);
            $trx->bsppc_number = $request->registration_number;
            $trx->expiry_date  = $request->expiry_date;
            $trx->phone_number = $request->phone_number;
            $trx->email        = $request->company_email;
            $trx->status       = "awaiting approval";
            if ($request->has('bsppc_certificate')) {
                $uploadedFileUrl = Cloudinary::upload($request->file('bsppc_certificate')->getRealPath())->getSecurePath();
                $trx->bsppc_cert = $uploadedFileUrl;
            }
            $trx->save();

            toast("Application Updated And Resubmitted For Review", 'success');
            return redirect()->route("business.companyRenewalDetails", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);
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
            'donor_company'         => 'required',
            'donee_company'         => 'required',
            'donee_company_address' => 'required',
            'donee_company_email'   => 'required',
            'donee_company_phone'   => 'required',
            'contract_name'         => 'required',
            'contract_sum'          => 'required',
            'contract_duration'     => 'required',
            'mda'                   => 'required',
            'contract_agreement'    => 'required|file|mimes:pdf',
            'poa_document'          => 'required|file|mimes:pdf',
            'award_notification'    => 'required|file|mimes:pdf',
            'donee_company_profile' => 'required|file|mimes:pdf',
            'boq_beme'              => 'required|file|mimes:pdf',
            'acceptance_letter'     => 'required|file|mimes:pdf',
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

            $trx                        = new PowerOfAttorney;
            $trx->reference_number      = $reference;
            $trx->company_id            = Auth::user()->company->id;
            $trx->donor_company         = $request->donor_company;
            $trx->donee_company         = $request->donee_company;
            $trx->donee_company_address = $request->donee_company_address;
            $trx->donee_company_email   = $request->donee_company_email;
            $trx->donee_company_phone   = $request->donee_company_phone;
            $trx->contract_name         = $request->contract_name;
            $trx->contract_amount       = $request->contract_sum;
            $trx->contract_duration     = $request->contract_duration;
            $trx->mda                   = $request->mda;
            $trx->amount_paid           = $item->amount;
            if ($request->has('contract_agreement')) {
                $contractAgreement       = Cloudinary::upload($request->file('contract_agreement')->getRealPath())->getSecurePath();
                $trx->contract_agreement = $contractAgreement;
            }
            if ($request->has('poa_document')) {
                $poaDocument       = Cloudinary::upload($request->file('poa_document')->getRealPath())->getSecurePath();
                $trx->poa_document = $poaDocument;
            }
            if ($request->has('award_notification')) {
                $awardNotification       = Cloudinary::upload($request->file('award_notification')->getRealPath())->getSecurePath();
                $trx->award_notification = $poaDocument;
            }
            if ($request->has('donee_company_profile')) {
                $doneeCompanyProfile        = Cloudinary::upload($request->file('donee_company_profile')->getRealPath())->getSecurePath();
                $trx->donee_company_profile = $doneeCompanyProfile;
            }
            if ($request->has('boq_beme')) {
                $boqBeme       = Cloudinary::upload($request->file('boq_beme')->getRealPath())->getSecurePath();
                $trx->boq_beme = $boqBeme;
            }
            if ($request->has('acceptance_letter')) {
                $acceptanceLetter       = Cloudinary::upload($request->file('acceptance_letter')->getRealPath())->getSecurePath();
                $trx->acceptance_letter = $acceptanceLetter;
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
            return redirect()->route("business.powerOfAttorneyPreview", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            toast("Something Went Wrong", 'error');
            return back();
        }

    }

    /**
     * editPoaApplication
     *
     * @param mixed reference
     *
     * @return void
     */
    public function editPoaApplication($reference)
    {
        $trx  = PowerOfAttorney::where("reference_number", $reference)->first();
        $mdas = Mda::all();
        return view("business.update_poa", compact("trx", "mdas"));
    }

    /**
     * updatePoaApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePoaApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'        => 'required',
            'donor_company'         => 'required',
            'donee_company'         => 'required',
            'donee_company_address' => 'required',
            'donee_company_email'   => 'required',
            'donee_company_phone'   => 'required',
            'contract_name'         => 'required',
            'contract_sum'          => 'required',
            'contract_duration'     => 'required',
            'mda'                   => 'required',
            'contract_agreement'    => 'nullable|file|mimes:pdf',
            'poa_document'          => 'nullable|file|mimes:pdf',
            'award_notification'    => 'nullable|file|mimes:pdf',
            'donee_company_profile' => 'nullable|file|mimes:pdf',
            'boq_beme'              => 'nullable|file|mimes:pdf',
            'acceptance_letter'     => 'nullable|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {

            $trx                        = PowerOfAttorney::find($request->application_id);
            $trx->donor_company         = $request->donor_company;
            $trx->donee_company         = $request->donee_company;
            $trx->donee_company_address = $request->donee_company_address;
            $trx->donee_company_email   = $request->donee_company_email;
            $trx->donee_company_phone   = $request->donee_company_phone;
            $trx->contract_name         = $request->contract_name;
            $trx->contract_amount       = $request->contract_sum;
            $trx->contract_duration     = $request->contract_duration;
            $trx->mda                   = $request->mda;
            $trx->status                = "awaiting approval";
            if ($request->has('contract_agreement')) {
                $contractAgreement       = Cloudinary::upload($request->file('contract_agreement')->getRealPath())->getSecurePath();
                $trx->contract_agreement = $contractAgreement;
            }
            if ($request->has('poa_document')) {
                $poaDocument       = Cloudinary::upload($request->file('poa_document')->getRealPath())->getSecurePath();
                $trx->poa_document = $poaDocument;
            }
            if ($request->has('award_notification')) {
                $awardNotification       = Cloudinary::upload($request->file('award_notification')->getRealPath())->getSecurePath();
                $trx->award_notification = $poaDocument;
            }
            if ($request->has('donee_company_profile')) {
                $doneeCompanyProfile        = Cloudinary::upload($request->file('donee_company_profile')->getRealPath())->getSecurePath();
                $trx->donee_company_profile = $doneeCompanyProfile;
            }
            if ($request->has('boq_beme')) {
                $boqBeme       = Cloudinary::upload($request->file('boq_beme')->getRealPath())->getSecurePath();
                $trx->boq_beme = $boqBeme;
            }
            if ($request->has('acceptance_letter')) {
                $acceptanceLetter       = Cloudinary::upload($request->file('acceptance_letter')->getRealPath())->getSecurePath();
                $trx->acceptance_letter = $acceptanceLetter;
            }
            $trx->save();
            toast("Application Updated And Resubmitted For Review", 'success');
            return redirect()->route("business.powerOfAttorneyDetails", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);

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
     * editPRFApplication
     *
     * @param mixed reference
     *
     * @return void
     */
    public function editPRFApplication($reference)
    {
        $trx  = ProcessingFee::where("reference_number", $reference)->first();
        $mdas = Mda::all();
        return view("business.update_processing_fee", compact("trx", "mdas"));
    }

    /**
     * updatePRFApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePRFApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'    => 'required',
            'company_name'      => 'required',
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

            $trx                    = ProcessingFee::find($request->application_id);
            $trx->company_name      = $request->company_name;
            $trx->contract_name     = $request->contract_name;
            $trx->award_date        = $request->date_of_award;
            $trx->contract_duration = $request->contract_duration;
            $trx->mda               = $request->mda;
            $trx->status            = "awaiting approval";
            $trx->save();
            toast("Application Updated And Resubmitted For Review", 'success');
            return redirect()->route("business.processingFeesDetails", [$trx->reference_number]);
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
            'fee_evidence'      => 'required',
            'tcc'               => 'required|file|mimes:pdf',
            'bsppc_certificate' => 'required|file|mimes:pdf',
            'cac_certificate'   => 'required|file|mimes:pdf',
            'advance_payment'   => 'nullable|file|mimes:pdf',
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
            $trx->fee_evidence      = $request->fee_evidence;
            $trx->company_id        = Auth::user()->company->id;
            $trx->company_name      = Auth::user()->company->company_name;
            $trx->contract_name     = $request->contract_name;
            $trx->contract_amount   = $request->contract_sum;
            $trx->award_date        = $request->date_of_award;
            $trx->contract_duration = $request->contract_duration;
            $trx->mda               = $request->mda;
            $trx->amount_paid       = $item->amount;
            if ($request->has('tcc')) {
                $tcc           = Cloudinary::upload($request->file('tcc')->getRealPath())->getSecurePath();
                $trx->tcc_cert = $tcc;
            }
            if ($request->has('bsppc_certificate')) {
                $bsppcCertificate = Cloudinary::upload($request->file('bsppc_certificate')->getRealPath())->getSecurePath();
                $trx->bsppc_cert  = $bsppcCertificate;
            }
            if ($request->has('cac_certificate')) {
                $cacCertificate = Cloudinary::upload($request->file('cac_certificate')->getRealPath())->getSecurePath();
                $trx->cac_cert  = $cacCertificate;
            }
            if ($request->has('advance_payment')) {
                $advancePayment       = Cloudinary::upload($request->file('advance_payment')->getRealPath())->getSecurePath();
                $trx->advance_payment = $advancePayment;
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
     * editAwardApplication
     *
     * @param mixed reference
     *
     * @return void
     */
    public function editAwardApplication($reference)
    {
        $trx  = AwardLetter::where("reference_number", $reference)->first();
        $mdas = Mda::all();
        return view("business.update_award_letter", compact("trx", "mdas"));
    }

    /**
     * updateAwardApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function updateAwardApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'    => 'required',
            'company_name'      => 'required',
            'contract_name'     => 'required',
            'contract_sum'      => 'required',
            'date_of_award'     => 'required',
            'contract_duration' => 'required',
            'mda'               => 'required',
            'fee_evidence'      => 'required',
            'tcc'               => 'nullable|file|mimes:pdf',
            'bsppc_certificate' => 'nullable|file|mimes:pdf',
            'cac_certificate'   => 'nullable|file|mimes:pdf',
            'advance_payment'   => 'nullable|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {

            $trx                    = AwardLetter::find($request->application_id);
            $trx->fee_evidence      = $request->fee_evidence;
            $trx->company_name      = $request->company_name;
            $trx->contract_name     = $request->contract_name;
            $trx->contract_amount   = $request->contract_sum;
            $trx->award_date        = $request->date_of_award;
            $trx->contract_duration = $request->contract_duration;
            $trx->mda               = $request->mda;
            $trx->status            = "awaiting approval";
            if ($request->has('tcc')) {
                $tcc           = Cloudinary::upload($request->file('tcc')->getRealPath())->getSecurePath();
                $trx->tcc_cert = $tcc;
            }
            if ($request->has('bsppc_certificate')) {
                $bsppcCertificate = Cloudinary::upload($request->file('bsppc_certificate')->getRealPath())->getSecurePath();
                $trx->bsppc_cert  = $bsppcCertificate;
            }
            if ($request->has('cac_certificate')) {
                $cacCertificate = Cloudinary::upload($request->file('cac_certificate')->getRealPath())->getSecurePath();
                $trx->cac_cert  = $cacCertificate;
            }
            if ($request->has('advance_payment')) {
                $advancePayment       = Cloudinary::upload($request->file('advance_payment')->getRealPath())->getSecurePath();
                $trx->advance_payment = $advancePayment;
            }
            $trx->save();
            toast("Application Updated And Resubmitted For Review", 'success');
            return redirect()->route("business.awardLettersDetails", [$trx->reference_number]);
        } catch (\Exception $e) {
            report($e);
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
        $companyId = isset(Auth::user()->company) ? Auth::user()->company->id : substr(md5(Str::uuid()), 0, 1);
        $random    = Auth::user()->id . "" . $companyId;

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
