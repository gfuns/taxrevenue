<?php

namespace App\Http\Controllers;

use App\Models\GeneralSettings;
use App\Models\JobListing;
use App\Models\PaymentGateway;
use App\Models\PlatformCategories;
use App\Models\PlatformFeature;
use App\Models\UserPermission;
use App\Models\UserRole;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlatformSettingsController extends Controller
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
     * platformCategories
     *
     * @return void
     */
    public function platformCategories()
    {
        $keyword = null;
        if (request()->search != null) {
            $marker = null;
            $lastRecord = null;
            $keyword = request()->search;
            $categories = PlatformCategories::where("category_name", "Like", "%{$keyword}%")->get();
        } else {
            $lastRecord = PlatformCategories::all()->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $categories = PlatformCategories::paginate(10);
        }

        return view('categories', compact('categories', 'marker', 'lastRecord', 'keyword'));
    }

    /**
     * storeCategory
     *
     * @param Request request
     *
     * @return void
     */
    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_icon' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $category = new PlatformCategories;
            $category->category_name = $request->category_name;
            if ($request->has('category_icon')) {
                $category->category_icon = Cloudinary::upload($request->file('category_icon')->getRealPath())->getSecurePath();
            }
            $category->user_id = Auth::user()->id;
            $category->save();
            toast('Category Created Successfully.', 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }

    }

    /**
     * updateCategory
     *
     * @param Request request
     *
     * @return void
     */
    public function updateCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {
            $category = PlatformCategories::find($request->category_id);
            $category->category_name = $request->category_name;
            if ($request->has('category_icon')) {
                $category->category_icon = Cloudinary::upload($request->file('category_icon')->getRealPath())->getSecurePath();
            }
            $category->save();
            toast('Category Updated Successfully.', 'success');
            return back();
        } catch (\Exception $e) {
            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }

    }

    /**
     * socialHandles
     *
     * @return void
     */
    public function socialHandles()
    {
        $socials = [
            'facebook' => GeneralSettings::where("setting", "facebook")->first()->setting_value,
            'twitter' => GeneralSettings::where("setting", "twitter")->first()->setting_value,
            'instagram' => GeneralSettings::where("setting", "instagram")->first()->setting_value,
            'youtube' => GeneralSettings::where("setting", "youtube")->first()->setting_value,
        ];
        return view('social_handles', compact('socials'));
    }

    /**
     * udpdateSocialHandles
     *
     * @param Request request
     *
     * @return void
     */
    public function udpdateSocialHandles(Request $request)
    {
        try {

            if ($request->has('facebook')) {
                $fb = GeneralSettings::where("setting", "facebook")->first();
                $fb->setting_value = $request->facebook;
                $fb->save();
            }

            if ($request->has('twitter')) {
                $tw = GeneralSettings::where("setting", "twitter")->first();
                $tw->setting_value = $request->twitter;
                $tw->save();
            }

            if ($request->has('youtube')) {
                $yt = GeneralSettings::where("setting", "youtube")->first();
                $yt->setting_value = $request->youtube;
                $yt->save();
            }

            if ($request->has('instagram')) {
                $in = GeneralSettings::where("setting", "instagram")->first();
                $in->setting_value = $request->instagram;
                $in->save();
            }

            toast('Social Media Accounts Updated Successfully.', 'success');
            return back();

        } catch (\Exception $e) {
            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * contactDetails
     *
     * @return void
     */
    public function contactDetails()
    {
        $contact = [
            'phone' => GeneralSettings::where("setting", "contact_phone")->first()->setting_value,
            'email' => GeneralSettings::where("setting", "contact_email")->first()->setting_value,
            'address' => GeneralSettings::where("setting", "contact_address")->first()->setting_value,
        ];
        return view('contact_details', compact('contact'));
    }

    /**
     * udpdateContactDetails
     *
     * @param Request request
     *
     * @return void
     */
    public function udpdateContactDetails(Request $request)
    {
        try {

            if ($request->has('contact_email')) {
                $email = GeneralSettings::where("setting", "contact_email")->first();
                $email->setting_value = $request->contact_email;
                $email->save();
            }

            if ($request->has('contact_phone')) {
                $phone = GeneralSettings::where("setting", "contact_phone")->first();
                $phone->setting_value = $request->contact_phone;
                $phone->save();
            }

            if ($request->has('contact_address')) {
                $address = GeneralSettings::where("setting", "contact_address")->first();
                $address->setting_value = $request->contact_address;
                $address->save();
            }

            toast('Contact Information Updated Successfully.', 'success');
            return back();

        } catch (\Exception $e) {
            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }
    }

    /**
     * paymentGateways
     *
     * @return void
     */
    public function paymentGateways()
    {
        $paystack = PaymentGateway::find(1);
        $stripe = PaymentGateway::find(2);
        return view("payment_gateways", compact('paystack', 'stripe'));
    }

    /**
     * updateStripeGateway
     *
     * @param Request request
     *
     * @return void
     */
    public function updateStripeGateway(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stripe_public' => 'required',
            'stripe_secret' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'STRIPE_PUBLIC_KEY=' . env('STRIPE_PUBLIC_KEY'), 'STRIPE_PUBLIC_KEY=' . $request->stripe_public, file_get_contents($path)
            ));

            file_put_contents($path, str_replace(
                'STRIPE_SECRET_KEY=' . env('STRIPE_SECRET_KEY'), 'STRIPE_SECRET_KEY=' . $request->stripe_secret, file_get_contents($path)
            ));
        }

        toast('Stripe Processor Configuration Successfully Updated', 'success');
        return back();

    }

    /**
     * updatePaystackGateway
     *
     * @param Request request
     *
     * @return void
     */
    public function updatePaystackGateway(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paystack_public' => 'required',
            'paystack_secret' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'PAYSTACK_PUBLIC_KEY=' . env('PAYSTACK_PUBLIC_KEY'), 'PAYSTACK_PUBLIC_KEY=' . $request->paystack_public, file_get_contents($path)
            ));

            file_put_contents($path, str_replace(
                'PAYSTACK_SECRET_KEY=' . env('PAYSTACK_SECRET_KEY'), 'PAYSTACK_SECRET_KEY=' . $request->paystack_secret, file_get_contents($path)
            ));
        }

        toast('Paystack Processor Configuration Successfully Updated', 'success');
        return back();

    }

    /**
     * activatePaymentGateway
     *
     * @param Request request
     *
     * @return void
     */
    public function activatePaymentGateway(Request $request)
    {
        try {

            PaymentGateway::where('id', $request->param)->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Payment Gateway Activated',
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again',
            ]);

        }
    }

    /**
     * rolesAndPermissions
     *
     * @return void
     */
    public function rolesAndPermissions()
    {
        if (request()->search != null) {
            $userRoles = UserRole::where("role", "LIKE", '%' . request()->search . '%')->get();
        } else {
            $userRoles = UserRole::all();
        }
        return view('manage_roles', compact('userRoles'));
    }

    /**
     * storeRole
     *
     * @param Request request
     *
     * @return void
     */
    public function storeRole(Request $request)
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

        $role = new UserRole;
        $role->role = $request->role;
        if ($role->save()) {
            toast('Role Created Successfully', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * updateRole
     *
     * @param Request request
     *
     * @return void
     */
    public function updateRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $parseRole = UserRole::where("role", $request->role)->where("id", "!=", $request->role_id)->count();
        if ($parseRole > 0) {
            toast('The provided role is already allocated.', 'error');
            return back();
        }

        $role = UserRole::find($request->role_id);
        $role->role = $request->role;
        if ($role->save()) {
            toast('Role Updated Successfully', 'success');
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
        $role = UserRole::find($id);
        $platformFeatures = PlatformFeature::all();
        return view('manage_permissions', compact('role', 'platformFeatures'));
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
        $permission = new UserPermission;
        $permission->role_id = $role;
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
        $permission = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
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
        $permission = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
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
        $permission = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
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
        $permission = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
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
        $permission = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
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
        $permission = UserPermission::where("role_id", $role)->where("feature_id", $feature)->first();
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
     * jobListing
     *
     * @param mixed id
     *
     * @return void
     */
    public function jobListing($id)
    {
        $category = PlatformCategories::find($id);
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->status)) {
            //Only search
            $lastRecord = JobListing::where("job_categories", "LIKE", '%' . $id . '%')->where("job_title", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("job_categories", "LIKE", '%' . $id . '%')->where("job_title", "LIKE", '%' . $search . '%')->paginate(50);

        } else if (!isset(request()->search) && isset(request()->status)) {
            //Only status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("job_categories", "LIKE", '%' . $id . '%')->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("job_categories", "LIKE", '%' . $id . '%')->whereIn("visibility", $fstatus)->paginate(50);

        } else if (isset(request()->search) && !isset(request()->author) && isset(request()->status)) {
            //Only search and status
            $fstatus = ($status == "published" ? array("open", "hired", "closed") : array($status));
            $lastRecord = JobListing::where("job_categories", "LIKE", '%' . $id . '%')->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("job_categories", "LIKE", '%' . $id . '%')->where("job_title", "LIKE", '%' . $search . '%')->whereIn("visibility", $fstatus)->paginate(50);

        } else {

            $lastRecord = JobListing::where("job_categories", "LIKE", '%' . $id . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $jobs = JobListing::orderBy("id", "desc")->where("job_categories", "LIKE", '%' . $id . '%')->paginate(50);
        }
        return view("category_jobs", compact("jobs", "lastRecord", "marker", "search", "status", "category"));
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
        $end = (10 * ((int) $pageNum));
        $marker = array();
        if ((int) $pageNum == 1) {
            $marker["begin"] = (int) $pageNum;
            $marker["index"] = (int) $pageNum;
        } else {
            $marker["begin"] = number_format(((10 * ((int) $pageNum)) - 9), 0);
            $marker["index"] = number_format(((10 * ((int) $pageNum)) - 9), 0);
        }

        if ($end > $lastRecord) {
            $marker["end"] = number_format($lastRecord, 0);
        } else {
            $marker["end"] = number_format($end, 0);
        }

        return $marker;
    }
}
