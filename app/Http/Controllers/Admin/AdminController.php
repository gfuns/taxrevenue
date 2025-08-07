<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreationMail as AccountCreationMail;
use App\Models\CollectionAgents;
use App\Models\Lgas;
use App\Models\Mda;
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
            'last_name'    => 'required',
            'other_names'  => 'required',
            'phone_number' => 'required',
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
            'role' => 'required|unique:user_roles',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $userRole       = new UserRole;
        $userRole->role = $request->role;
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

        $userRole       = UserRole::find($request->role_id);
        $userRole->role = $request->role;
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
        $status    = request()->status;
        $search    = request()->search;
        $userRoles = UserRole::where("id", ">", 2)->get();

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = User::query()->where("role_id", ">", 2)->whereLike(["last_name", "other_names", "email", "phone_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $users      = User::query()->where("role_id", ">", 2)->whereLike(["last_name", "other_names", "email", "phone_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = User::query()->where("role_id", ">", 2)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $users      = User::query()->where("role_id", ">", 2)->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = User::query()->where("role_id", ">", 2)->whereLike(["last_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $users      = User::query()->where("role_id", ">", 2)->whereLike(["last_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord = User::where("role_id", ">", 2)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $users      = User::where("role_id", ">", 2)->paginate(50);
        }

        return view("admin.user_management", compact('users', 'userRoles', 'status', 'search'));
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
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $role               = UserRole::find($request->role);
        $user               = new User;
        $user->other_names  = $request->other_names;
        $user->last_name    = $request->last_name;
        $user->email        = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password     = Hash::make($request->phone_number);
        $user->role         = $role->role;
        $user->role_id      = $role->id;
        $user->token        = Str::random(60);
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

        $role               = UserRole::find($request->role);
        $user               = User::find($request->user_id);
        $user->other_names  = $request->other_names;
        $user->last_name    = $request->last_name;
        $user->email        = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role         = $role->role;
        $user->role_id      = $role->id;
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
        return view("admin.revenue_items", compact("paymentItems", "search", "status", "lastRecord", "marker"));
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
        $item->mda_id       = 1;
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
        $item->mda_id       = 1;
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

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord  = TaxConsultants::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->count();
            $marker      = $this->getMarkers($lastRecord, request()->page);
            $consultants = TaxConsultants::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord  = PaymentItem::query()->where("status", $status)->count();
            $marker      = $this->getMarkers($lastRecord, request()->page);
            $consultants = TaxConsultants::query()->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord  = TaxConsultants::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->count();
            $marker      = $this->getMarkers($lastRecord, request()->page);
            $consultants = TaxConsultants::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord  = TaxConsultants::count();
            $marker      = $this->getMarkers($lastRecord, request()->page);
            $consultants = TaxConsultants::paginate(50);
        }
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
            'first_name'    => 'required',
            'other_names'   => 'nullable',
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
            $consultant->surname      = $request->surname;
            $consultant->first_name   = $request->first_name;
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
            'first_name'    => 'required',
            'other_names'   => 'nullable',
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
            $consultant->surname      = $request->surname;
            $consultant->first_name   = $request->first_name;
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

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = CollectionAgents::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $agents     = CollectionAgents::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = CollectionAgents::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $agents     = CollectionAgents::query()->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = CollectionAgents::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $agents     = CollectionAgents::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord = CollectionAgents::count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $agents     = CollectionAgents::paginate(50);
        }

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
            $consultant                    = new CollectionAgents;
            $consultant->surname           = $request->surname;
            $consultant->first_name        = $request->first_name;
            $consultant->other_names       = $request->other_names;
            $consultant->email             = $request->email;
            $consultant->phone_number      = $request->phone_number;
            $consultant->gender            = $request->gender;
            $consultant->assigned_location = $request->assigned_location;
            if ($request->has('profile_photo')) {
                $uploadedFileUrl   = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
                $consultant->photo = $uploadedFileUrl;
            }
            $consultant->save();

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

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord   = PosTerminals::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $posTerminals = PosTerminals::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord   = PosTerminals::query()->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $posTerminals = PosTerminals::query()->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord   = PosTerminals::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $posTerminals = PosTerminals::query()->whereLike(["surname", "first_name", "other_names", "email", "phone_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = PosTerminals::count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $posTerminals = PosTerminals::paginate(50);
        }
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

        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord = $taxPayers = $taxPayers = TaxPayer::query()
                ->where(function ($query) use ($search) {
                    $query->whereLike(["tax_payer", "btin"], $search);
                })
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->whereLike(["email", "phone_number"], $search);
                })
                ->count();
            $marker    = $this->getMarkers($lastRecord, request()->page);
            $taxPayers = $taxPayers = TaxPayer::query()
                ->where(function ($query) use ($search) {
                    $query->whereLike(["tax_payer", "btin"], $search);
                })
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->whereLike(["email", "phone_number"], $search);
                })
                ->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = TaxPayer::with('user')
                ->whereHas('user', function ($query) use ($status) {
                    $query->where('status', $status);
                })
                ->count();
            $marker    = $this->getMarkers($lastRecord, request()->page);
            $taxPayers = TaxPayer::with('user')
                ->whereHas('user', function ($query) use ($status) {
                    $query->where('status', $status);
                })
                ->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = TaxPayer::with('user')
                ->whereHas('user', function ($query) use ($status) {
                    $query->where('status', $status);
                })
                ->where(function ($query) use ($search) {
                    $query->whereLike(['tax_payer', 'btin'], $search)
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->whereLike(['email', 'phone_number'], $search);
                        });
                })
                ->count();
            $marker    = $this->getMarkers($lastRecord, request()->page);
            $taxPayers = TaxPayer::with('user')
                ->whereHas('user', function ($query) use ($status) {
                    $query->where('status', $status);
                })
                ->where(function ($query) use ($search) {
                    $query->whereLike(['tax_payer', 'btin'], $search)
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->whereLike(['email', 'phone_number'], $search);
                        });
                })
                ->paginate(50);
        } else {
            $lastRecord = TaxPayer::count();
            $marker     = $this->getMarkers($lastRecord, request()->page);
            $taxPayers  = TaxPayer::with('user')->paginate(50);
        }
        return view("admin.tax_payers", compact("taxPayers", "search", "status", "lastRecord", "marker"));
    }

    /**
     * taxPayerDetails
     *
     * @param mixed id
     *
     * @return void
     */
    public function taxPayerDetails($id)
    {
        $taxpayer = TaxPayer::find($id);
        return view("admin.taxpayer_details", compact("taxpayer"));
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
