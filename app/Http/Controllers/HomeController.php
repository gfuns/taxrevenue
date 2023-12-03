<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreationMail as AccountCreationMail;
use App\Models\AreteWalletTransaction;
use App\Models\User;
use App\Models\UserRole;
use Auth;
use Cloudinary;
use Coderatio\SimpleBackup\SimpleBackup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HomeController extends Controller
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

    public function slopy()
    {
        $response = Http::accept('application/json')->withHeaders([
            'XGW-KEY' => "ARETE-WEB-BTR77-AKQ9O6-OZZODM5K",
        ])->get("https://app.areteplanet.com/native/v1/settings/application-key");

        $data = $response->collect("data");
        return $data["application_key"];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * profile
     *
     * @return void
     */
    public function profile()
    {
        return view("profile");
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
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);

        $parseEmail = User::where("email", $request->email)->where("id", "!=", Auth::user()->id)->count();
        if ($parseEmail > 0) {
            toast('Email already taken by someone else.', 'error');
            return back();
        }

        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        if ($request->has('profile_photo')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('profile_photo')->getRealPath())->getSecurePath();
            $user->profile_photo = $uploadedFileUrl;
        }

        if ($user->save()) {
            toast('Account Information Successfully Updated.', 'success');
            return back();
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
        return view("change_password");
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
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
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
     * databaseBackup
     *
     * @return void
     */
    public function databaseBackup()
    {
        $simpleBackup = SimpleBackup::start()
            ->setDbHost(env('DB_HOST'))
            ->setDbName(env('DB_DATABASE'))
            ->setDbUser(env('DB_USERNAME'))
            ->setDbPassword(env('DB_PASSWORD'))
            ->then()->downloadAfterExport();
    }

    /**
     * administrators
     *
     * @return void
     */
    public function administrators()
    {
        $keyword = null;
        if (request()->search != null) {
            $marker = null;
            $lastRecord = null;
            $keyword = request()->search;
            $admins = User::query()->whereLike(['first_name', 'last_name'], $keyword)->get();
        } else {
            $lastRecord = User::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $admins = User::paginate(50);
        }
        $userRoles = UserRole::orderBy('role', 'asc')->get();
        return view("administrators", compact('admins', 'marker', 'lastRecord', 'userRoles', 'keyword'));
    }

    /**
     * storeAdmin
     *
     * @param Request request
     *
     * @return void
     */
    public function storeAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        try {

            $role = UserRole::find($request->role);

            $password = Str::random(8);

            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->role = $role->role;
            $user->role_id = $role->id;
            $user->token = Str::random(16);
            if ($user->save()) {

                try {
                    Mail::to($user)->send(new AccountCreationMail($user, $password));
                } catch (\Exception $e) {
                    report($e);
                } finally {
                    toast('Account Created Successfully.', 'success');
                    return back();
                }

                toast('Account Created Successfully.', 'success');
                return back();
            } else {
                toast('Something went wrong. Please try again', 'error');
                return back();
            }
        } catch (\Exception $e) {
            report($e);
            toast($e->getMessage(), 'error');
            return back();
        }
    }

/**
 * updateAdmin
 *
 * @param Request request
 *
 * @return void
 */

    public function updateAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $parseEmail = User::where("email", $request->email)->where("id", "!=", $request->admin_id)->count();
        if ($parseEmail > 0) {
            toast('Email already taken by someone else.', 'error');
            return back();
        }

        try {
            $role = UserRole::find($request->role);

            $user = User::find($request->admin_id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->role = $role->role;
            $user->role_id = $role->id;
            if ($user->save()) {
                toast('Account Updated Successfully.', 'success');
                return back();
            } else {
                toast('Something went wrong. Please try again', 'error');
                return back();
            }
        } catch (\Exception $e) {
            report($e);
            toast('Something went wrong', 'error');
            return back();
        }
    }

    /**
     * suspendAdmin
     *
     * @param mixed id
     *
     * @return void
     */
    public function suspendAdmin($id)
    {
        $user = User::find($id);
        $user->status = "Locked";
        if ($user->save()) {
            toast('Account Locked Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * activateAdmin
     *
     * @param mixed id
     *
     * @return void
     */
    public function activateAdmin($id)
    {
        $user = User::find($id);
        $user->status = "Active";
        if ($user->save()) {
            toast('Account Unlocked Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * deleteAdmin
     *
     * @param mixed id
     *
     * @return void
     */
    public function deleteAdmin($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            toast('Account Deleted Successfully.', 'success');
            return back();
        } else {
            toast('Something went wrong. Please try again', 'error');
            return back();
        }
    }

    /**
     * customerDeposits
     *
     * @return void
     */
    public function customerDeposits()
    {
        $search = request()->search;
        if (isset(request()->search)) {
            //Only Search has a value

            $records = AreteWalletTransaction::orderBy("id", "desc")->select('arete_wallet_transactions.id', 'arete_wallet_transactions.customer_id', 'arete_wallet_transactions.card_id', 'arete_wallet_transactions.amount', 'arete_wallet_transactions.created_at', 'arete_wallet_transactions.payment_method', 'arete_wallet_transactions.trx_type')
                ->join('customers as c1', 'arete_wallet_transactions.customer_id', '=', 'c1.id')
                ->where(function ($query) use ($search) {
                    $query->where("payment_method", "Card")
                        ->where("trx_type", "credit")
                        ->where('c1.first_name', "LIKE", '%' . $search . '%')
                        ->orWhere('c1.last_name', "LIKE", '%' . $search . '%');
                });

            $lastRecord = $records->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $deposits = $records->paginate(50);
        } else {

            $lastRecord = AreteWalletTransaction::where("payment_method", "Card")->where("trx_type", "credit")->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $deposits = AreteWalletTransaction::orderBy("id", "desc")->where("payment_method", "Card")->where("trx_type", "credit")->paginate(50);
        }
        return view("customer_deposits", compact("deposits", "lastRecord", "marker", "search"));
    }

    /**
     * customerWithdrawals
     *
     * @return void
     */
    public function customerWithdrawals()
    {
        $search = request()->search;
        if (isset(request()->search)) {
            //Only Search has a value

            $records = AreteWalletTransaction::orderBy("id", "desc")->select('arete_wallet_transactions.id', 'arete_wallet_transactions.customer_id', 'arete_wallet_transactions.bank', 'arete_wallet_transactions.account_number', 'arete_wallet_transactions.account_name', 'arete_wallet_transactions.amount', 'arete_wallet_transactions.created_at', 'arete_wallet_transactions.payment_method', 'arete_wallet_transactions.trx_type')
                ->join('customers as c1', 'arete_wallet_transactions.customer_id', '=', 'c1.id')
                ->where(function ($query) use ($search) {
                    $query->where("payment_method", "Wallet")
                        ->where("trx_type", "debit")
                        ->where('c1.first_name', "LIKE", '%' . $search . '%')
                        ->orWhere('c1.last_name', "LIKE", '%' . $search . '%');
                });

            $lastRecord = $records->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $withdrawals = $records->paginate(50);
        } else {

            $lastRecord = AreteWalletTransaction::where("payment_method", "Wallet")->where("trx_type", "debit")->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $withdrawals = AreteWalletTransaction::orderBy("id", "desc")->where("payment_method", "Wallet")->where("trx_type", "debit")->paginate(50);
        }
        return view("customer_withdrawals", compact("withdrawals", "lastRecord", "marker", "search"));
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
        $end = (50 * ((int) $pageNum));
        $marker = array();
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
