<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreationMail as AccountCreationMail;
use App\Models\Assessments;
use App\Models\CollectionAgents;
use App\Models\Lgas;
use App\Models\Mda;
use App\Models\PaymentHistory;
use App\Models\PaymentItem;
use App\Models\PlatformFeature;
use App\Models\PosTerminals;
use App\Models\TaxConsultants;
use App\Models\TaxOffice;
use App\Models\TaxPayer;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Auth;
use Carbon\Carbon;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use PDF;
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

        return view("admin.dashboard", compact("params", "dataSets"));
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
            'last_name'     => 'required',
            'other_names'   => 'required',
            'phone_number'  => 'required',
            'profile_photo' => 'required',
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
        $user->profile_updated = 1;
        if ($request->has('profile_photo')) {
            $uploadedFileUrl     = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
            $user->profile_photo = $uploadedFileUrl;
        }

        if ($user->save()) {
            toast('Profile Information Successfully Updated.', 'success');
            return back();
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

    /**
     * platformFeatures
     *
     * @return void
     */
    public function platformFeatures()
    {
        $platformFeatures = PlatformFeature::all();
        return view("admin.platform_features", compact("platformFeatures"));
    }

    /**
     * userRoles
     *
     * @return void
     */
    public function userRoles()
    {
        $userRoles = UserRole::where("id", ">", 3)->get();
        return view("admin.role_management", compact("userRoles"));
    }

    /**
     * storeUserRole
     *
     * @param Request request
     *
     * @return void
     */
    public function storeUserRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role'     => 'required|unique:user_roles',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $userRole           = new UserRole;
        $userRole->role     = $request->role;
        $userRole->category = $request->category;
        if ($userRole->save()) {
            toast('User Role Created Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();

        }
    }

    /**
     * updateUserRole
     *
     * @param Request request
     *
     * @return void
     */
    public function updateUserRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'role'    => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $userRole           = UserRole::find($request->role_id);
        $userRole->role     = $request->role;
        $userRole->category = $request->category;
        if ($userRole->save()) {
            $users = User::where("role_id", $userRole->id)->update(["role" => $userRole->role]);
            toast('User Role Updated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * userManagement
     *
     * @return void
     */
    public function userManagement()
    {
        $status     = request()->status;
        $search     = request()->search;
        $userRoles  = UserRole::where("id", ">", 3)->get();
        $mdas       = Mda::all();
        $taxOffices = TaxOffice::all();

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = User::query()->where("role_id", ">", 3)->whereLike(["last_name", "other_names", "email", "phone_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $users      = User::query()->where("role_id", ">", 3)->whereLike(["last_name", "other_names", "email", "phone_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = User::query()->where("role_id", ">", 3)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $users      = User::query()->where("role_id", ">", 3)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = User::query()->where("role_id", ">", 3)->whereLike(["last_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $users      = User::query()->where("role_id", ">", 3)->whereLike(["last_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord = User::where("role_id", ">", 3)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $users      = User::where("role_id", ">", 3)->paginate(50);
        }

        return view("admin.user_management", compact('users', 'userRoles', 'status', 'search', "mdas", "taxOffices"));
    }

    /**
     * storeUser
     *
     * @param Request request
     *
     * @return void
     */
    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'other_names'  => 'required',
            'last_name'    => 'required',
            'email'        => 'required|unique:users',
            'phone_number' => 'required|unique:users',
            'role'         => 'required',
            'category'     => 'required',
            'mda'          => 'required_if:category,mda admin',
            'tax_office'   => 'required_if:category,birs area office',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $role                = UserRole::find($request->role);
        $user                = new User;
        $user->other_names   = $request->other_names;
        $user->last_name     = $request->last_name;
        $user->email         = $request->email;
        $user->phone_number  = $request->phone_number;
        $user->password      = Hash::make($request->phone_number);
        $user->role          = $role->role;
        $user->role_id       = $role->id;
        $user->category      = $request->category;
        $user->mda_id        = $request->mda;
        $user->tax_office_id = $request->tax_office;
        $user->token         = Str::random(60);
        if ($user->save()) {
            try {
                Mail::to($user)->send(new AccountCreationMail($user, $user->phone_number));
            } catch (\Exception $e) {
                report($e);
            }
            toast('User Information Stored Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * updateUser
     *
     * @param Request request
     *
     * @return void
     */
    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'      => 'required',
            'other_names'  => 'required',
            'last_name'    => 'required',
            'email'        => 'required',
            'phone_number' => 'required',
            'role'         => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $emailTaken = User::where("id", "!=", $request->user_id)->where("email", $request->email)->first();
        if (isset($emailTaken)) {
            toast('This Email Has Already Been Taken By Another User.', 'error');
            return back();
        }

        $phoneTaken = User::where("id", "!=", $request->user_id)->where("phone_number", $request->phone_number)->first();
        if (isset($phoneTaken)) {
            toast('This Phone Number Has Already Been Taken By Another User.', 'error');
            return back();
        }

        $role                = UserRole::find($request->role);
        $user                = User::find($request->user_id);
        $user->other_names   = $request->other_names;
        $user->last_name     = $request->last_name;
        $user->email         = $request->email;
        $user->phone_number  = $request->phone_number;
        $user->role          = $role->role;
        $user->role_id       = $role->id;
        $user->category      = $request->category;
        $user->mda_id        = $request->mda;
        $user->tax_office_id = $request->tax_office;
        if ($user->save()) {
            toast('User Information Updated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * suspendUser
     *
     * @param mixed id
     *
     * @return void
     */
    public function suspendUser($id)
    {
        $user         = User::find($id);
        $user->status = "suspended";
        if ($user->save()) {
            toast('User Account Suspended Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * activateUser
     *
     * @param mixed id
     *
     * @return void
     */
    public function activateUser($id)
    {
        $user         = User::find($id);
        $user->status = "active";
        if ($user->save()) {
            toast('User Account Activated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * managePermissions
     *
     * @param mixed id
     *
     * @return void
     */
    public function managePermissions($id)
    {
        $role             = UserRole::find($id);
        $platformFeatures = PlatformFeature::all();
        return view("admin.permissions", compact("role", "platformFeatures"));
    }

    /**
     * grantFeaturePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function grantFeaturePermission($role, $feature)
    {
        $permission             = new UserPermission;
        $permission->role_id    = $role;
        $permission->feature_id = $feature;
        if ($permission->save()) {
            toast('Feature Permission Granted', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * revokeFeaturePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function revokeFeaturePermission($role, $feature)
    {
        $permission = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
        if ($permission->delete()) {
            toast('Feature Permission Revoked', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * grantCreatePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function grantCreatePermission($role, $feature)
    {
        $permission             = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_create = 1;
        if ($permission->save()) {
            toast('Can Create Permission Granted', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * revokeCreatePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function revokeCreatePermission($role, $feature)
    {
        $permission             = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_create = 0;
        if ($permission->save()) {
            toast('Can Create Permission Revoked', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * grantEditPermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function grantEditPermission($role, $feature)
    {
        $permission           = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_edit = 1;
        if ($permission->save()) {
            toast('Can Edit Permission Granted', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * revokeEditPermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function revokeEditPermission($role, $feature)
    {
        $permission           = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_edit = 0;
        if ($permission->save()) {
            toast('Can Edit Permission Revoked', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * grantDeletePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function grantDeletePermission($role, $feature)
    {
        $permission             = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_delete = 1;
        if ($permission->save()) {
            toast('Can Delete Permission Granted', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * revokeDeletePermission
     *
     * @param mixed role
     * @param mixed feature
     *
     * @return void
     */
    public function revokeDeletePermission($role, $feature)
    {
        $permission             = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
        $permission->can_delete = 0;
        if ($permission->save()) {
            toast('Can Delete Permission Revoked', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * areaTaxOffices
     *
     * @return void
     */
    public function areaTaxOffices()
    {
        $search = request()->search;
        $status = request()->status;
        $lgas   = Lgas::all();

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = TaxOffice::query()->whereLike(["tax_office"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $taxOffices = TaxOffice::query()->whereLike(["tax_office"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = TaxOffice::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $taxOffices = TaxOffice::query()->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = TaxOffice::query()->whereLike(["tax_office"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $taxOffices = TaxOffice::query()->whereLike(["tax_office"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord = TaxOffice::count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $taxOffices = TaxOffice::paginate(50);
        }
        return view("admin.area_tax_offices", compact("taxOffices", "search", "status", "lgas", "lastRecord", "marker"));
    }

    /**
     * storeTaxOffice
     *
     * @param Request request
     *
     * @return void
     */
    public function storeTaxOffice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tax_office'     => 'required',
            'office_address' => 'required',
            'lga'            => 'required',
            'email'          => 'required',
            'phone_number'   => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $office               = new TaxOffice;
        $office->lga_id       = $request->lga;
        $office->tax_office   = $request->tax_office;
        $office->email        = $request->email;
        $office->phone_number = $request->phone_number;
        $office->address      = $request->office_address;
        if ($office->save()) {
            toast("Area Tax Office Created Successfully.", 'success');
            return back();
        } else {
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * updateTaxOffice
     *
     * @param Request request
     *
     * @return void
     */
    public function updateTaxOffice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'office_id'      => 'required',
            'tax_office'     => 'required',
            'office_address' => 'required',
            'lga'            => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $office               = TaxOffice::find($request->office_id);
        $office->lga_id       = $request->lga;
        $office->tax_office   = $request->tax_office;
        $office->email        = $request->email;
        $office->phone_number = $request->phone_number;
        $office->address      = $request->office_address;
        if ($office->save()) {
            toast("Area Tax Office Updated Successfully.", 'success');
            return back();
        } else {
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * manageMDAs
     *
     * @return void
     */
    public function manageMDAs()
    {
        $search = request()->search;
        $status = request()->status;

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = Mda::query()->whereLike(["mda", "mda_code"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $mdas       = Mda::query()->whereLike(["mda", "mda_code"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = Mda::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $mdas       = Mda::query()->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = Mda::query()->whereLike(["mda", "mda_code"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $mdas       = Mda::query()->whereLike(["mda", "mda_code"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord = Mda::count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $mdas       = Mda::paginate(50);
        }
        return view("admin.manage_mdas", compact("mdas", "search", "status", "lastRecord", "marker"));
    }

    /**
     * storeMDA
     *
     * @param Request request
     *
     * @return void
     */
    public function storeMDA(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mda'      => 'required',
            'mda_code' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $mda           = new Mda;
        $mda->mda      = ucwords(strtolower($request->mda));
        $mda->mda_code = $request->mda_code;
        if ($mda->save()) {
            toast("MDA Created Successfully.", 'success');
            return back();
        } else {
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * updateMDA
     *
     * @param Request request
     *
     * @return void
     */
    public function updateMDA(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mda_id'   => 'required',
            'mda'      => 'required',
            'mda_code' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $mda           = Mda::find($request->mda_id);
        $mda->mda      = ucwords(strtolower($request->mda));
        $mda->mda_code = $request->mda_code;
        if ($mda->save()) {
            toast("MDA Updated Successfully.", 'success');
            return back();
        } else {
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
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
        $mda    = request()->mda;

        $query = PaymentItem::query();

        if (isset(request()->mda)) {
            $query->where("mda_id", $mda);
        }

        if (isset(request()->search)) {
            $query->whereLike(["revenue_item", "revenue_code"], $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $paymentItems = $query->paginate(50);

        $agencies = Mda::all();

        return view("admin.revenue_items", compact("paymentItems", "search", "status", "lastRecord", "marker", "mda", "agencies"));

    }

    /**
     * storeRevenueItem
     *
     * @param Request request
     *
     * @return void
     */
    public function storeRevenueItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'revenue_item' => 'required',
            'revenue_code' => 'required',
            'config_type'  => 'required',
            'mda_id'       => 'required',
            'amount'       => 'required_if:config_type,fixed',
            'percentage'   => 'required_if:config_type,percentage',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $item               = new PaymentItem;
        $item->mda_id       = $request->mda_id;
        $item->revenue_item = ucwords(strtolower($request->revenue_item));
        $item->revenue_code = $request->revenue_code;
        $item->fee_config   = $request->config_type;
        $item->amount       = $request->amount;
        $item->percentage   = $request->percentage;
        if ($item->save()) {
            toast("Revenue Item Created Successfully.", 'success');
            return back();
        } else {
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * updateRevenueItem
     *
     * @param Request request
     *
     * @return void
     */
    public function updateRevenueItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id'      => 'required',
            'revenue_item' => 'required',
            'revenue_code' => 'required',
            'config_type'  => 'required',
            'amount'       => 'required_if:config_type,fixed',
            'percentage'   => 'required_if:config_type,percentage',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $item               = PaymentItem::find($request->item_id);
        $item->revenue_item = ucwords(strtolower($request->revenue_item));
        $item->revenue_code = $request->revenue_code;
        $item->fee_config   = $request->config_type;
        $item->amount       = $request->amount;
        $item->percentage   = $request->percentage;
        if ($item->save()) {
            toast("Revenue Item Updated Successfully.", 'success');
            return back();
        } else {
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * taxConsultants
     *
     * @return void
     */
    public function taxConsultants()
    {
        $search = request()->search;
        $status = request()->status;

        $query = TaxConsultants::query();

        if (isset(request()->search)) {
            $query->whereLike(["surname", "organization", "other_names", "email", "phone_number"], $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $consultants = $query->paginate(50);

        return view("admin.tax_consultants", compact("consultants", "search", "status", "lastRecord", "marker"));
    }

    /**
     * storeConsultant
     *
     * @param Request request
     *
     * @return void
     */
    public function storeConsultant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surname'       => 'required',
            'organization'  => 'required',
            'other_names'   => 'required',
            'email'         => 'required|unique:tax_consultants',
            'phone_number'  => 'required|unique:tax_consultants',
            'gender'        => 'required',
            'profile_photo' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $consultant               = new TaxConsultants;
            $consultant->organization = ucwords(strtolower($request->organization));
            $consultant->surname      = $request->surname;
            $consultant->other_names  = $request->other_names;
            $consultant->email        = $request->email;
            $consultant->phone_number = $request->phone_number;
            $consultant->gender       = $request->gender;
            if ($request->has('profile_photo')) {
                $uploadedFileUrl   = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
                $consultant->photo = $uploadedFileUrl;
            }
            $consultant->save();

            toast("Tax Consultant Created Successfully.", 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * updateConsultant
     *
     * @param Request request
     *
     * @return void
     */
    public function updateConsultant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'consultant_id' => 'required',
            'surname'       => 'required',
            'organization'  => 'required',
            'other_names'   => 'required',
            'email'         => 'required',
            'phone_number'  => 'required',
            'gender'        => 'required',
            'profile_photo' => 'nullable',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $consultant               = TaxConsultants::find($request->consultant_id);
            $consultant->organization = ucwords(strtolower($request->organization));
            $consultant->surname      = $request->surname;
            $consultant->other_names  = $request->other_names;
            $consultant->email        = $request->email;
            $consultant->phone_number = $request->phone_number;
            $consultant->gender       = $request->gender;
            if ($request->has('profile_photo')) {
                $uploadedFileUrl   = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
                $consultant->photo = $uploadedFileUrl;
            }
            $consultant->save();

            toast("Tax Consultant Updated Successfully.", 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * collectionAgents
     *
     * @return void
     */
    public function collectionAgents()
    {
        $search = request()->search;
        $status = request()->status;

        $query = CollectionAgents::query();

        if (isset(request()->search)) {
            $query->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $agents = $query->paginate(50);

        $posTerminals = PosTerminals::where("assigned", 0)->get();
        return view("admin.collection_agents", compact("agents", "search", "status", "lastRecord", "marker", "posTerminals"));
    }

    /**
     * storeCollectionAgent
     *
     * @param Request request
     *
     * @return void
     */
    public function storeCollectionAgent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'surname'           => 'required',
            'first_name'        => 'required',
            'other_names'       => 'nullable',
            'email'             => 'required|unique:collection_agents',
            'phone_number'      => 'required|unique:collection_agents',
            'gender'            => 'required',
            'profile_photo'     => 'required',
            'assigned_location' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $agent                    = new CollectionAgents;
            $agent->surname           = $request->surname;
            $agent->first_name        = $request->first_name;
            $agent->other_names       = $request->other_names;
            $agent->email             = $request->email;
            $agent->phone_number      = $request->phone_number;
            $agent->gender            = $request->gender;
            $agent->assigned_location = $request->assigned_location;
            if ($request->has('profile_photo')) {
                $uploadedFileUrl = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
                $agent->photo    = $uploadedFileUrl;
            }
            $agent->save();

            toast("Collection Agent Created Successfully.", 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * updateCollectionAgent
     *
     * @param Request request
     *
     * @return void
     */
    public function updateCollectionAgent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agent_id'          => 'required',
            'surname'           => 'required',
            'first_name'        => 'required',
            'other_names'       => 'nullable',
            'email'             => 'required',
            'phone_number'      => 'required',
            'gender'            => 'required',
            'assigned_location' => 'required',
            'profile_photo'     => 'nullable',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $agent                    = CollectionAgents::find($request->agent_id);
            $agent->surname           = $request->surname;
            $agent->first_name        = $request->first_name;
            $agent->other_names       = $request->other_names;
            $agent->email             = $request->email;
            $agent->phone_number      = $request->phone_number;
            $agent->gender            = $request->gender;
            $agent->assigned_location = $request->assigned_location;
            if ($request->has('profile_photo')) {
                $uploadedFileUrl = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
                $agent->photo    = $uploadedFileUrl;
            }
            $agent->save();

            toast("Collection Agent Details Updated Successfully.", 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * posTerminals
     *
     * @return void
     */
    public function posTerminals()
    {
        $search = request()->search;
        $status = request()->status;

        $query = PosTerminals::query();

        if (isset(request()->search)) {
            $query->whereLike(["serial_number", "terminal_id"], $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $posTerminals = $query->paginate(50);

        return view("admin.pos_terminals", compact("posTerminals", "search", "status", "lastRecord", "marker"));

    }

    /**
     * storePosTerminal
     *
     * @param Request request
     *
     * @return void
     */
    public function storePosTerminal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pos_model'       => 'required',
            'terminal_id'     => 'required|unique:pos_terminals',
            'serial_number'   => 'required|unique:pos_terminals',
            'ip_address'      => 'nullable|unique:pos_terminals',
            'notification_ip' => 'nullable|unique:pos_terminals',
            'sim_number'      => 'nullable|unique:pos_terminals',
            'port'            => 'nullable',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $posTerminal                  = new PosTerminals;
            $posTerminal->model           = $request->pos_model;
            $posTerminal->terminal_id     = $request->terminal_id;
            $posTerminal->serial_number   = $request->serial_number;
            $posTerminal->ip_address      = $request->ip_address;
            $posTerminal->notification_ip = $request->notification_ip;
            $posTerminal->sim             = $request->sim_number;
            $posTerminal->port            = $request->port;
            $posTerminal->save();

            toast("POS Terminal Created Successfully.", 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * updatePosTerminal
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePosTerminal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pos_id'          => 'required',
            'pos_model'       => 'required',
            'terminal_id'     => 'required',
            'serial_number'   => 'required',
            'ip_address'      => 'nullable',
            'notification_ip' => 'nullable',
            'sim_number'      => 'nullable',
            'port'            => 'nullable',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $posTerminal                  = PosTerminals::find($request->pos_id);
            $posTerminal->model           = $request->pos_model;
            $posTerminal->terminal_id     = $request->terminal_id;
            $posTerminal->serial_number   = $request->serial_number;
            $posTerminal->ip_address      = $request->ip_address;
            $posTerminal->notification_ip = $request->notification_ip;
            $posTerminal->sim             = $request->sim_number;
            $posTerminal->port            = $request->port;
            $posTerminal->save();

            toast("POS Terminal Updated Successfully.", 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast("Something Went Wrong. Please try again", 'error');
            return back();
        }
    }

    /**
     * releaseTerminal
     *
     * @param mixed id
     *
     * @return void
     */
    public function releaseTerminal($id)
    {
        try {
            DB::beginTransaction();

            $agent              = CollectionAgents::find($id);
            $terminal           = PosTerminals::find($agent->terminal_id);
            $terminal->assigned = 0;
            $terminal->save();

            $agent->terminal_id = null;
            $agent->save();

            DB::commit();

            toast('Assigned POS Terminal Released Successfully', 'success');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            report($e);

            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * assignTerminal
     *
     * @param Request request
     *
     * @return void
     */
    public function assignTerminal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agent_id'          => 'required',
            'pos_terminal'      => 'required',
            'assigned_location' => 'required',
            'longitude'         => 'required',
            'latitude'          => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {

            $terminal = PosTerminals::find($request->pos_terminal);

            if (isset($terminal)) {

                DB::beginTransaction();
                $terminal->assigned          = 1;
                $terminal->assigned_location = $request->assigned_location;
                $terminal->longitude         = $request->longitude;
                $terminal->latitude          = $request->latitude;
                $terminal->status            = "active";
                $terminal->save();

                $agent              = CollectionAgents::find($request->agent_id);
                $agent->terminal_id = $terminal->id;
                $agent->save();
                DB::commit();

                toast('POS Terminal Assigned Successfully', 'success');
                return back();

            } else {
                toast('We Could Not Locate The Configuration For The Selected POS Terminal', 'success');
                return back();
            }

        } catch (\Exception $e) {
            DB::rollback();
            report($e);

            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * taxPayers
     *
     * @return void
     */
    public function taxPayers()
    {
        $search = request()->search;
        $status = request()->status;

        $query = TaxPayer::query();

        if (Auth::user()->category == "birs area office") {
            $query->where("tax_office_id", Auth::user()->tax_office_id);
        }

        if (isset(request()->search)) {
            $query->where(function ($param) use ($search) {
                $param->whereLike(["tax_payer", "btin"], $search);
            })
                ->orWhereHas('user', function ($param) use ($search) {
                    $param->whereLike(["email", "phone_number"], $search);
                });
        }

        if (isset(request()->status)) {
            $query->whereHas('user', function ($param) use ($status) {
                $param->where('status', $status);
            });
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);
        $taxPayers  = $query->paginate(50);

        return view("admin.tax_payers", compact("taxPayers", "search", "status", "lastRecord", "marker"));

    }

    /**
     * taxPayerDetails
     *
     * @param mixed btin
     *
     * @return void
     */
    public function taxPayerDetails($btin)
    {
        $taxPayer = TaxPayer::where("btin", $btin)->first();
        if (isset($taxPayer)) {
            $search = request()->search;
            $status = request()->status;

            $query = PaymentHistory::query();

            $query->where("tax_payer_id", $taxPayer->id);

            if (isset(request()->search)) {
                $query->where("reference", $search);
            }

            if (isset(request()->status)) {
                $query->where("status", $status);
            }

            $lastRecord = $query->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $paymentHistory = $query->paginate(50);

            return view("admin.taxpayer_details", compact("taxPayer", "paymentHistory", "search", "status", "lastRecord", "marker", ));

        } else {
            toast('B-TIN does not exist on our records', 'error');
            return redirect()->route("admin.taxPayers");
        }
    }

    /**
     * suspendTaxPayer
     *
     * @param mixed id
     *
     * @return void
     */
    public function suspendTaxPayer($id)
    {
        $taxpayer         = User::find($id);
        $taxpayer->status = "suspended";
        if ($taxpayer->save()) {
            toast('Tax Payer Account Suspended Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * activateTaxPayer
     *
     * @param mixed id
     *
     * @return void
     */
    public function activateTaxPayer($id)
    {
        $taxpayer         = User::find($id);
        $taxpayer->status = "active";
        if ($taxpayer->save()) {
            toast('Tax Payer Account Activated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * mdaGeneratedRevenue
     *
     * @return void
     */
    public function mdaGeneratedRevenue()
    {
        $search = request()->search;
        $status = request()->status;
        $mda    = request()->mda;

        $query = PaymentHistory::query();

        $query->whereNotNull("mda_id");

        if (Auth::user()->category == "birs area office") {
            $query->where("tax_office_id", Auth::user()->tax_office_id);
        }

        if (isset(request()->mda)) {
            $query->where("mda_id", $mda);
        }

        if (isset(request()->search)) {
            $query->where("reference", $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $paymentHistory = $query->paginate(50);

        $agencies = Mda::all();

        return view("admin.mda_revenue", compact("paymentHistory", "search", "status", "lastRecord", "marker", "mda", "agencies"));

    }

    /**
     * developmentLevies
     *
     * @return void
     */
    public function developmentLevies()
    {
        $search = request()->search;
        $status = request()->status;

        $query = PaymentHistory::query();

        $query->where("payment_type_id", 1);

        if (Auth::user()->category == "birs area office") {
            $query->where("tax_office_id", Auth::user()->tax_office_id);
        }

        if (isset(request()->search)) {
            $query->where("reference", $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $paymentHistory = $query->paginate(50);

        return view("admin.development_levies", compact("paymentHistory", "search", "status", "lastRecord", "marker"));

    }

    /**
     * personalIncomeTaxes
     *
     * @return void
     */
    public function personalIncomeTaxes()
    {
        $search = request()->search;
        $status = request()->status;

        $query = PaymentHistory::query();

        $query->where("payment_type_id", 2);

        if (Auth::user()->category == "birs area office") {
            $query->where("tax_office_id", Auth::user()->tax_office_id);
        }

        if (isset(request()->search)) {
            $query->where("reference", $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $paymentHistory = $query->paginate(50);

        return view("admin.personal_income_taxes", compact("paymentHistory", "search", "status", "lastRecord", "marker"));
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

        $query = PaymentHistory::query();

        $query->where("payment_type_id", 3);

        if (Auth::user()->category == "birs area office") {
            $query->where("tax_office_id", Auth::user()->tax_office_id);
        }

        if (isset(request()->search)) {
            $query->where("reference", $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $paymentHistory = $query->paginate(50);

        return view("admin.filed_returns", compact("paymentHistory", "search", "status", "lastRecord", "marker"));
    }

    /**
     * otherTaxes
     *
     * @return void
     */
    public function otherTaxes()
    {
        $search = request()->search;
        $status = request()->status;

        $query = PaymentHistory::query();

        $query->where("payment_type_id", 4);

        if (Auth::user()->category == "birs area office") {
            $query->where("tax_office_id", Auth::user()->tax_office_id);
        }

        if (isset(request()->search)) {
            $query->where("reference", $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $paymentHistory = $query->paginate(50);

        return view("admin.other_taxes", compact("paymentHistory", "search", "status", "lastRecord", "marker"));
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
        return view("admin.payment_details", compact("trx"));
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
     * generateBill
     *
     * @return void
     */
    public function generateBill()
    {
        $mdas           = Mda::all();
        $areaTaxOffices = TaxOffice::all();
        return view("admin.generate_bill", compact("mdas", "areaTaxOffices"));
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
            'tax_office'   => 'required',
            'mda'          => 'required',
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

        $taxOffice = $request->tax_office;

        if (isset($request->btin)) {
            $taxpayer = TaxPayer::where("btin", $request->btin)->first();
        }

        $bill = new PaymentHistory;

        if (isset($request->btin)) {
            $bill->user_id      = isset($taxpayer) ? $taxpayer->user_id : null;
            $bill->tax_payer_id = isset($taxpayer) ? $taxpayer->id : null;
            $taxOffice          = isset($taxpayer) ? $taxpayer->tax_office_id : $request->tax_office;
        }

        $bill->tax_office_id   = $taxOffice;
        $bill->tax_payer       = $request->tax_payer;
        $bill->period          = $request->start_period . " - " . $request->end_period;
        $bill->mda_id          = $request->mda;
        $bill->narration       = $revenueItem->revenue_item . " Payment";
        $bill->payment_item_id = $revenueItem->id;
        $bill->payment_type_id = $revenueItem->payment_type_id;
        $bill->amount          = $amount;
        $bill->fee_charged     = $feeCharged;
        $bill->total           = ($amount + $feeCharged);
        if ($bill->save()) {
            toast('Bill Generated Successfully.', 'success');
            return redirect()->route("admin.billPreview", [$bill->reference]);
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * validateBtin
     *
     * @param Request request
     *
     * @return void
     */
    public function validateBtin(Request $request)
    {
        $taxpayer = TaxPayer::where("btin", $request->btin)->first();

        if (isset($taxpayer)) {
            return response()->json(['taxpayer' => $taxpayer->tax_payer], 200);
        } else {
            return response()->json(['message' => "B-TIN Validation Failed"], 400);
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
        return view("admin.bill_preview", compact("trx"));
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

        view()->share(['trx' => $trx]);

        $pdf      = PDF::loadView('mda.payment_advise');
        $fileName = "Payment Advice - " . $reference . ".pdf";
        return $pdf->download($fileName);

        return view("admin.payment_advise", compact("trx"));
    }

    /**
     * assessments
     *
     * @return void
     */
    public function assessments()
    {
        $search = request()->search;
        $status = request()->status;

        $query = Assessments::query();

        if (Auth::user()->category == "birs area office") {
            $query->where("tax_office_id", Auth::user()->tax_office_id);
        }

        if (isset(request()->search)) {
            $query->where("reference", $search);
        }

        if (isset(request()->status)) {
            $query->where("status", $status);
        }

        $lastRecord = $query->count();
        $marker     = $this->getMarkers($lastRecord, request()->page);

        $assessments = $query->paginate(50);
        return view("admin.assessments", compact("assessments", "search", "status", "lastRecord", "marker"));
    }

    /**
     * assessmentDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function assessmentDetails($reference)
    {
        $assessment = Assessments::where("reference", $reference)->first();
        return view("admin.assessment_details", compact("assessment"));
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
