<?php
namespace App\Http\Controllers;

use App\Models\ConsultantRequests;
use App\Models\TaxConsultants;
use App\Models\TaxOffice;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class TaxPayerController extends Controller
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
        $assignedConsultants = ConsultantRequests::where("user_id", Auth::user()->id)->get();
        return view("individual.tax_consultants", compact("taxConsultants", "assignedConsultants", "search", "lastRecord", "marker"));
    }

    /**
     * requestConsultant
     *
     * @param Request request
     *
     * @return void
     */
    public function requestConsultant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'consultant_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $consReq                = new ConsultantRequests;
        $consReq->user_id       = Auth::user()->id;
        $consReq->tax_payer_id  = Auth::user()->taxpayer->id;
        $consReq->consultant_id = $request->consultant_id;
        if ($consReq->save()) {
            toast('Consultant Request Submitted Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

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
