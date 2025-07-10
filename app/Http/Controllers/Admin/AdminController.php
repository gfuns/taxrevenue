<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwardLetter;
use App\Models\CompanyRenewals;
use App\Models\Mda;
use App\Models\PowerOfAttorney;
use App\Models\ProcessingFee;
use App\Models\User;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view("admin.dashboard");
    }

    /**
     * profile
     *
     * @return void
     */
    public function viewProfile()
    {
        return view("admin.profile");
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
        return view("admin.security", compact("google2faSecret", "QRImage"));
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

    public function companyRegistration()
    {

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
            $lastRecord = CompanyRenewals::query()->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = CompanyRenewals::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = CompanyRenewals::query()->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = CompanyRenewals::count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = CompanyRenewals::orderBy("id", "desc")->paginate(50);
        }
        return view("admin.company_renewals", compact("transactions", "search", "status", "lastRecord", "marker"));
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
            $lastRecord = PowerOfAttorney::query()->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = PowerOfAttorney::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = PowerOfAttorney::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = PowerOfAttorney::query()->orderBy("id", "desc")->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = PowerOfAttorney::query()->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = PowerOfAttorney::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = PowerOfAttorney::count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = PowerOfAttorney::orderBy("id", "desc")->paginate(50);
        }

        $mdas = Mda::all();
        return view("admin.poa", compact("transactions", "search", "status", "lastRecord", "marker", "mdas"));
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
            $lastRecord = ProcessingFee::query()->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = ProcessingFee::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = ProcessingFee::query()->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = ProcessingFee::count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = ProcessingFee::orderBy("id", "desc")->paginate(50);
        }

        $mdas = Mda::all();
        return view("admin.processing_fees", compact("transactions", "search", "status", "lastRecord", "marker", "mdas"));
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
            $lastRecord = AwardLetter::query()->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = AwardLetter::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->orderBy("id", "desc")->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = AwardLetter::query()->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = AwardLetter::count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = AwardLetter::orderBy("id", "desc")->paginate(50);
        }

        $mdas = Mda::all();
        return view("admin.award_letters", compact("transactions", "search", "status", "lastRecord", "marker", "mdas"));
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
