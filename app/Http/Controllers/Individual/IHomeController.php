<?php
namespace App\Http\Controllers\Individual;

use App\Http\Controllers\Controller;
use App\Models\IndividualTaxpayer;
use App\Models\TaxOffice;
use App\Models\TaxPayer;
use App\Models\User;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
