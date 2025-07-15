<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreationMail as AccountCreationMail;
use App\Mail\PoaApproval as PoaApproval;
use App\Mail\PoaRejection as PoaRejection;
use App\Mail\ProcessingApproval as ProcessingApproval;
use App\Mail\ProcessingRejection as ProcessingRejection;
use App\Mail\RegistrationApproval as RegistrationApproval;
use App\Mail\RegistrationRejection as RegistrationRejection;
use App\Mail\RenewalApproval as RenewalApproval;
use App\Mail\RenewalRejection as RenewalRejection;
use App\Models\AwardLetter;
use App\Models\BusinessCategories;
use App\Models\Company;
use App\Models\CompanyDocuments;
use App\Models\CompanyProjects;
use App\Models\CompanyRenewals;
use App\Models\Mda;
use App\Models\PaymentItem;
use App\Models\PlatformFeature;
use App\Models\PowerOfAttorney;
use App\Models\ProcessingFee;
use App\Models\UploadableDocs;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Auth;
use Carbon\Carbon;
use Cloudinary;
use Illuminate\Http\Request;
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
            "regs"     => Company::whereIn("status", ["awaiting approval", "approved", "rejected"])->sum("amount_paid"),
            "renewals" => CompanyRenewals::whereIn("status", ["awaiting approval", "approved", "rejected"])->sum("amount_paid"),
            "poas"     => PowerOfAttorney::whereIn("status", ["awaiting approval", "approved", "rejected"])->sum("amount_paid"),
            "awards"   => AwardLetter::whereIn("status", ["awaiting approval", "approved", "rejected"])->sum("amount_paid"),
            "prFees"   => ProcessingFee::whereIn("status", ["awaiting approval", "approved", "rejected"])->sum("amount_paid"),
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
            $datasets['registrations'][] = Company::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)->sum("amount_paid");

            $datasets['renewals'][] = CompanyRenewals::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)->sum("amount_paid");

            $datasets['poa'][] = PowerOfAttorney::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)->sum("amount_paid");

            $datasets['award_letters'][] = AwardLetter::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)->sum("amount_paid");

            $datasets['processing'][] = ProcessingFee::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)->sum("amount_paid");
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
     * paymentItems
     *
     * @return void
     */
    public function paymentItems()
    {
        $paymentItems = PaymentItem::orderBy("ordering", "asc")->get();
        return view("admin.payment_items", compact("paymentItems"));
    }

    /**
     * businessCategories
     *
     * @return void
     */
    public function businessCategories()
    {
        $categories = BusinessCategories::all();
        return view("admin.business_categories", compact("categories"));
    }

    /**
     * storeBusinessCategory
     *
     * @param Requesr request
     *
     * @return void
     */
    public function storeBusinessCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $category           = new BusinessCategories;
        $category->category = $request->category;
        if ($category->save()) {
            toast("Business Category Created Successfully.", 'success');
            return back();
        } else {
            toast("We could not create the provided business category", 'error');
            return back();

        }
    }

    /**
     * updateBusinessCategory
     *
     * @param Request request
     *
     * @return void
     */
    public function updateBusinessCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'category'    => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $category           = BusinessCategories::find($request->category_id);
        $category->category = $request->category;
        if ($category->save()) {
            toast("Business Category Updated Successfully.", 'success');
            return back();
        } else {
            toast("We could not updated the selected business category", 'error');
            return back();

        }
    }

    /**
     * activateCategory
     *
     * @param mixed id
     *
     * @return void
     */
    public function activateCategory($id)
    {
        $user         = BusinessCategories::find($id);
        $user->status = "active";
        if ($user->save()) {
            toast('Category Activated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * deactivateCategory
     *
     * @param mixed id
     *
     * @return void
     */
    public function deactivateCategory($id)
    {
        $user         = BusinessCategories::find($id);
        $user->status = "deactivated";
        if ($user->save()) {
            toast('Category Deactivated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * documentManagement
     *
     * @return void
     */
    public function documentManagement()
    {
        $documents = UploadableDocs::all();
        return view("admin.document_management", compact("documents"));
    }

    /**
     * storeUpDoc
     *
     * @param Request request
     *
     * @return void
     */
    public function storeUpDoc(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_title' => 'required',
            'operation'      => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $doc                 = new UploadableDocs;
        $doc->document_title = $request->document_title;
        $doc->category       = $request->operation;
        if ($doc->save()) {
            toast("Document Information Captured Successfully.", 'success');
            return back();
        } else {
            toast("We could not capture the provided document information", 'error');
            return back();

        }
    }

    /**
     * updateUpDoc
     *
     * @param Request request
     *
     * @return void
     */
    public function updateUpDoc(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_id'    => 'required',
            'document_title' => 'required',
            'operation'      => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $doc                 = UploadableDocs::find($request->document_id);
        $doc->document_title = $request->document_title;
        $doc->category       = $request->operation;
        if ($doc->save()) {
            toast("Document Information Updated Successfully.", 'success');
            return back();
        } else {
            toast("We could not updated the provided document information", 'error');
            return back();

        }
    }

    /**
     * activateDocument
     *
     * @param mixed id
     *
     * @return void
     */
    public function activateDocument($id)
    {
        $doc         = UploadableDocs::find($id);
        $doc->status = "active";
        if ($doc->save()) {
            toast('Document Activated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * deactivateDocument
     *
     * @param mixed id
     *
     * @return void
     */
    public function deactivateDocument($id)
    {
        $doc         = UploadableDocs::find($id);
        $doc->status = "deactivated";
        if ($doc->save()) {
            toast('Document Deactivated Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * updatePaymentItem
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePaymentItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id'           => 'required',
            'payment_item'      => 'required',
            'application_fee'   => 'required',
            'fee_configuration' => 'required',
            'fee'               => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $item             = PaymentItem::find($request->item_id);
        $item->item       = $request->payment_item;
        $item->amount     = $request->application_fee;
        $item->fee_config = $request->fee_configuration;
        $item->fee        = $request->fee;
        if ($item->save()) {
            toast("Payment item updated successfully.", 'success');
            return back();
        } else {
            toast("We could not update the selected payment item", 'error');
            return back();
        }
    }

    /**
     * userRoles
     *
     * @return void
     */
    public function userRoles()
    {
        $userRoles = UserRole::where("id", ">", 2)->get();
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
     * companyRegistrations
     *
     * @return void
     */
    public function companyRegistrations()
    {
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && ! isset(request()->status)) {
            $lastRecord   = Company::query()->where("status")->whereLike(["company_name", "bsppc_number", "cac_number"], $search)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Company::query()->whereIn("status", ["awaiting approval", "approved", "rejected"])->whereLike(["company_name", "bsppc_number", "cac_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord   = Company::query()->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Company::query()->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord   = Company::query()->whereLike(["company_name", "bsppc_number", "cac_number"], $search)->where("status", $status)->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Company::query()->whereLike(["company_name", "bsppc_number", "cac_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = Company::whereIn("status", ["awaiting approval", "approved", "rejected"])->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = Company::whereIn("status", ["awaiting approval", "approved", "rejected"])->paginate(50);
        }
        return view("admin.company_registrations", compact("transactions", "search", "status", "lastRecord", "marker"));
    }

    /**
     * companyRegDetails
     *
     * @param mixed id
     *
     * @return void
     */
    public function companyRegDetails($id)
    {
        $company          = Company::find($id);
        $documents        = CompanyDocuments::where("company_id", $company->id)->get();
        $executedProjects = CompanyProjects::where("company_id", $company->id)->get();
        return view("admin.application_details", compact("company", "documents", "executedProjects"));
    }

    /**
     * approveCompanyReg
     *
     * @param mixed id
     *
     * @return void
     */
    public function approveCompanyReg($id)
    {
        $company         = Company::find($id);
        $company->status = "approved";
        if ($company->application_type == "registration") {
            $company->bsppc_number = $this->gerateBssppcNumber($id);
        }
        if ($company->save()) {
            try {
                $user = User::find($company->user_id);
                Mail::to($user)->send(new RegistrationApproval($user, $company));
            } catch (\Exception $e) {
                report($e);
            }
            toast('Contractor Registration Successfully Approved', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * rejectCompanyReg
     *
     * @param Request request
     *
     * @return void
     */
    public function rejectCompanyReg(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'   => 'required',
            'rejection_reason' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $company                   = Company::find($request->application_id);
        $company->status           = "rejected";
        $company->rejection_reason = $request->rejection_reason;
        if ($company->save()) {
            try {
                $user = User::find($company->user_id);
                Mail::to($user)->send(new RegistrationRejection($user, $company));
            } catch (\Exception $e) {
                report($e);
            }
            toast('Contractor Registration Rejected', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * gerateBssppcNumber
     *
     * @param mixed id
     *
     * @return void
     */
    public function gerateBssppcNumber($id)
    {
        $company     = Company::find($id);
        $bsppcNoPref = "BNSPPC/" . strtoupper($company->classification);
        if (strlen($id) == 1) {
            return $bsppcNoPref . "0000" . $id;
        } else if (strlen($id) == 2) {
            return $bsppcNoPref . "000" . $id;
        } else if (strlen($id) == 3) {
            return $bsppcNoPref . "00" . $id;
        } else if (strlen($id) == 4) {
            return $bsppcNoPref . "0" . $id;
        } else if (strlen($id) == 5) {
            return $bsppcNoPref . $id;
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
            $lastRecord = CompanyRenewals::query()->whereIn("status", ["awaiting approval", "approved", "rejected"])->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->whereIn("status", ["awaiting approval", "approved", "rejected"])->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = CompanyRenewals::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = CompanyRenewals::query()->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = CompanyRenewals::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = CompanyRenewals::whereIn("status", ["awaiting approval", "approved", "rejected"])->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = CompanyRenewals::orderBy("id", "desc")->whereIn("status", ["awaiting approval", "approved", "rejected"])->paginate(50);
        }
        return view("admin.company_renewals", compact("transactions", "search", "status", "lastRecord", "marker"));
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
        return view("admin.company_renewal_details", compact("trx"));
    }

    /**
     * approveCompanyRenewal
     *
     * @param mixed id
     *
     * @return void
     */
    public function approveCompanyRenewal($id)
    {
        $renewal         = CompanyRenewals::find($id);
        $renewal->status = "approved";
        if ($renewal->save()) {
            try {
                $user = User::find($renewal->company->user_id);
                Mail::to($user)->send(new RenewalApproval($user, $renewal));
            } catch (\Exception $e) {
                report($e);
            }
            toast('Contractor Renewal Application Successfully Approved', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * rejectCompanyRenewal
     *
     * @param Request request
     *
     * @return void
     */
    public function rejectCompanyRenewal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'   => 'required',
            'rejection_reason' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $renewal                   = CompanyRenewals::find($request->application_id);
        $renewal->status           = "rejected";
        $renewal->rejection_reason = $request->rejection_reason;
        if ($renewal->save()) {
            try {
                $user = User::find($renewal->company->user_id);
                Mail::to($user)->send(new RenewalRejection($user, $renewal));
            } catch (\Exception $e) {
                report($e);
            }
            toast('Contractor Renewal Application Rejected', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
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
     * powerOfAttorneyDetails
     *
     * @param mixed reference
     *
     * @return void
     */
    public function powerOfAttorneyDetails($reference)
    {
        $trx = PowerOfAttorney::where("reference_number", $reference)->first();
        return view("admin.poa_details", compact("trx"));
    }

    /**
     * approvePoaApplication
     *
     * @param mixed id
     *
     * @return void
     */
    public function approvePoaApplication($id)
    {
        $poa         = PowerOfAttorney::find($id);
        $poa->status = "approved";
        if ($poa->save()) {
            try {
                $user = User::find($poa->company->user_id);
                Mail::to($user)->send(new PoaApproval($user, $poa));
            } catch (\Exception $e) {
                report($e);
            }
            toast('Power Of Attorney  Application Successfully Approved', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * rejectPoaApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function rejectPoaApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'   => 'required',
            'rejection_reason' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $poa                   = PowerOfAttorney::find($request->application_id);
        $poa->status           = "rejected";
        $poa->rejection_reason = $request->rejection_reason;
        if ($poa->save()) {
            try {
                $user = User::find($poa->company->user_id);
                Mail::to($user)->send(new PoaRejection($user, $poa));
            } catch (\Exception $e) {
                report($e);
            }
            toast('Power Of Attorney Application Rejected', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
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
            $lastRecord = ProcessingFee::query()->whereIn("status", ["awaiting approval", "approved", "rejected"])->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->whereIn("status", ["awaiting approval", "approved", "rejected"])->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = ProcessingFee::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = ProcessingFee::query()->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = ProcessingFee::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = ProcessingFee::whereIn("status", ["awaiting approval", "approved", "rejected"])->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = ProcessingFee::orderBy("id", "desc")->whereIn("status", ["awaiting approval", "approved", "rejected"])->paginate(50);
        }

        $mdas = Mda::all();
        return view("admin.processing_fees", compact("transactions", "search", "status", "lastRecord", "marker", "mdas"));
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
        return view("admin.processing_fee_details", compact("trx"));
    }

    /**
     * approvePrfApplication
     *
     * @param mixed id
     *
     * @return void
     */
    public function approvePrfApplication($id)
    {
        $procFee         = ProcessingFee::find($id);
        $procFee->status = "approved";
        if ($procFee->save()) {
            try {
                $user = User::find($procFee->company->user_id);
                Mail::to($user)->send(new ProcessingApproval($user, $procFee));
            } catch (\Exception $e) {
                report($e);
            }
            toast('Processing Fee Remmittance Successfully Approved', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * rejectPrfApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function rejectPrfApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'   => 'required',
            'rejection_reason' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $procFee                   = ProcessingFee::find($request->application_id);
        $procFee->status           = "rejected";
        $procFee->rejection_reason = $request->rejection_reason;
        if ($procFee->save()) {
            try {
                $user = User::find($procFee->company->user_id);
                Mail::to($user)->send(new ProcessingRejection($user, $procFee));
            } catch (\Exception $e) {
                report($e);
            }
            toast('Processing Fee Remmittance Rejected', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
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
            $lastRecord = AwardLetter::query()->whereIn("status", ["awaiting approval", "approved", "rejected"])->whereLike(["reference_number"], $search)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->whereIn("status", ["awaiting approval", "approved", "rejected"])->orderBy("id", "desc")->whereLike(["reference_number"], $search)->paginate(50);
        } else if (! isset(request()->search) && isset(request()->status)) {
            $lastRecord = AwardLetter::query()->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->orderBy("id", "desc")->where("status", $status)->paginate(50);
        } else if (isset(request()->search) && isset(request()->status)) {
            $lastRecord = AwardLetter::query()->whereLike(["reference_number"], $search)->where("status", $status)->count();
            $marker     = $this->getMarkers($lastRecord, request()->page);

            $transactions = AwardLetter::query()->orderBy("id", "desc")->whereLike(["reference_number"], $search)->where("status", $status)->paginate(50);
        } else {
            $lastRecord   = AwardLetter::whereIn("status", ["awaiting approval", "approved", "rejected"])->count();
            $marker       = $this->getMarkers($lastRecord, request()->page);
            $transactions = AwardLetter::orderBy("id", "desc")->whereIn("status", ["awaiting approval", "approved", "rejected"])->paginate(50);
        }

        $mdas = Mda::all();
        return view("admin.award_letters", compact("transactions", "search", "status", "lastRecord", "marker", "mdas"));
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
        return view("admin.award_letter_details", compact("trx"));
    }

    /**
     * approveAwardApplication
     *
     * @param mixed id
     *
     * @return void
     */
    public function approveAwardApplication($id)
    {
        $poa         = AwardLetter::find($id);
        $poa->status = "approved";
        if ($poa->save()) {
            toast('Award Letter Application Successfully Approved', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * rejectAwardApplication
     *
     * @param Request request
     *
     * @return void
     */
    public function rejectAwardApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_id'   => 'required',
            'rejection_reason' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $poa                   = AwardLetter::find($request->application_id);
        $poa->status           = "rejected";
        $poa->rejection_reason = $request->rejection_reason;
        if ($poa->save()) {
            toast('Award Letter Application Rejected', 'success');
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
