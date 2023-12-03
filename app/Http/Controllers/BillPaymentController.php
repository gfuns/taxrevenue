<?php

namespace App\Http\Controllers;

use App\Models\AirtimeProviders;
use App\Models\CableProvider;
use App\Models\DataProvider;
use App\Models\ElectricityProviders;
use App\Models\UtilityTransactions;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillPaymentController extends Controller
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
     * airtimeProviders
     *
     * @return void
     */
    public function airtimeProviders()
    {
        $airtimeProviders = AirtimeProviders::all();
        return view("airtime_providers", compact('airtimeProviders'));
    }

    /**
     * storeAirtimeProvider
     *
     * @param Request request
     *
     * @return void
     */
    public function storeAirtimeProvider(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'provider_name' => 'required',
            'transaction_fee' => 'required',
            'provider_logo' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = new AirtimeProviders;
        $provider->biller = $request->provider_name;
        $provider->fee = $request->transaction_fee;
        if ($request->has('provider_logo')) {
            $provider->biller_logo = Cloudinary::uploadFile($request->file('provider_logo')->getRealPath())->getSecurePath();
        }

        if ($provider->save()) {
            toast('Airtime Provider Added Successfully.', 'success');
            return back();

        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();

        }
    }

    /**
     * updateAirtimeProvider
     *
     * @param Request request
     *
     * @return void
     */
    public function updateAirtimeProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required',
            'provider_name' => 'required',
            'transaction_fee' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = AirtimeProviders::find($request->provider_id);
        $provider->biller = $request->provider_name;
        $provider->fee = $request->transaction_fee;
        if ($request->has('provider_logo')) {
            $provider->biller_logo = Cloudinary::uploadFile($request->file('provider_logo')->getRealPath())->getSecurePath();
        }

        if ($provider->save()) {
            toast('Provider Details Updated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }
    }

    /**
     * deleteAirtimeProvider
     *
     * @param id
     *
     * @return void
     */

    public function deleteAirtimeProvider($id)
    {

        $provider = AirtimeProviders::find($id);
        if ($provider->delete()) {
            toast('Selected Provider Deleted Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * deactivateAirtimeProvider
     *
     * @param id
     *
     * @return void
     */
    public function deactivateAirtimeProvider($id)
    {

        $provider = AirtimeProviders::find($id);
        $provider->status = "Deactivated";
        if ($provider->save()) {
            toast('Selected Provider Deactivated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * activateAirtimeProvider
     *
     * @param id
     *
     * @return void
     */
    public function activateAirtimeProvider($id)
    {

        $provider = AirtimeProviders::find($id);
        $provider->status = "Active";
        if ($provider->save()) {
            toast('Selected Provider Activated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * electricityProviders
     *
     * @return void
     */
    public function electricityProviders()
    {
        $electricityProviders = ElectricityProviders::all();
        return view("electricity_providers", compact('electricityProviders'));
    }

    /**
     * storeElectricityProvider
     *
     * @param Request request
     *
     * @return void
     */
    public function storeElectricityProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_name' => 'required',
            'service_id' => 'required',
            'acronym' => 'required',
            'transaction_fee' => 'required',
            'provider_logo' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = new ElectricityProviders;
        $provider->biller = $request->provider_name;
        $provider->service_id = $request->service_id;
        $provider->acronym = $request->acronym;
        $provider->fee = $request->transaction_fee;
        if ($request->has('provider_logo')) {
            $provider->biller_logo = Cloudinary::uploadFile($request->file('provider_logo')->getRealPath())->getSecurePath();
        }

        if ($provider->save()) {
            toast('Electricity Provider Added Successfully.', 'success');
            return back();

        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }
    }

    /**
     * updateElectricityProvider
     *
     * @param Request request
     *
     * @return void
     */
    public function updateElectricityProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required',
            'provider_name' => 'required',
            'service_id' => 'required',
            'acronym' => 'required',
            'transaction_fee' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = ElectricityProviders::find($request->provider_id);
        $provider->biller = $request->provider_name;
        $provider->service_id = $request->service_id;
        $provider->acronym = $request->acronym;
        $provider->fee = $request->transaction_fee;
        if ($request->has('provider_logo')) {
            $provider->biller_logo = Cloudinary::uploadFile($request->file('provider_logo')->getRealPath())->getSecurePath();
        }

        if ($provider->save()) {
            toast('Provider Information Updated Successfully.', 'success');
            return back();

        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }
    }

    /**
     * deleteElectricityProvider
     *
     * @param id
     *
     * @return void
     */
    public function deleteElectricityProvider($id)
    {

        $provider = ElectricityProviders::find($id);
        if ($provider->delete()) {
            toast('Selected Provider Deleted Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * deactivateElectricityProvider
     *
     * @param id
     *
     * @return void
     */
    public function deactivateElectricityProvider($id)
    {

        $provider = ElectricityProviders::find($id);
        $provider->status = "Deactivated";
        if ($provider->save()) {
            toast('Selected Provider Deactivated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * activateElectricityProvider
     *
     * @param id
     *
     * @return void
     */
    public function activateElectricityProvider($id)
    {

        $provider = ElectricityProviders::find($id);
        $provider->status = "Active";
        if ($provider->save()) {
            toast('Selected Provider Activated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * cableProviders
     *
     * @return void
     */
    public function cableProviders()
    {
        $cableProviders = CableProvider::all();
        return view("cable_providers", compact('cableProviders'));
    }

    /**
     * storeCableProvider
     *
     * @param Request request
     *
     * @return void
     */
    public function storeCableProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_name' => 'required',
            'service_id' => 'required',
            'transaction_fee' => 'required',
            'provider_logo' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = new CableProvider;
        $provider->biller = $request->provider_name;
        $provider->service_id = $request->service_id;
        $provider->fee = $request->transaction_fee;
        if ($request->has('provider_logo')) {
            $provider->biller_logo = Cloudinary::uploadFile($request->file('provider_logo')->getRealPath())->getSecurePath();
        }

        if ($provider->save()) {
            toast('Cable Provider Added Successfully.', 'success');
            return back();

        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }
    }

    /**
     * updateCableProvider
     *
     * @param Request request
     *
     * @return void
     */
    public function updateCableProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required',
            'provider_name' => 'required',
            'service_id' => 'required',
            'transaction_fee' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = CableProvider::find($request->provider_id);
        $provider->biller = $request->provider_name;
        $provider->service_id = $request->service_id;
        $provider->fee = $request->transaction_fee;
        if ($request->has('provider_logo')) {
            $provider->biller_logo = Cloudinary::uploadFile($request->file('provider_logo')->getRealPath())->getSecurePath();
        }

        if ($provider->save()) {
            toast('Provider Information Updated Successfully.', 'success');
            return back();

        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }
    }

    /**
     * deleteCableProvider
     *
     * @param id
     *
     * @return void
     */
    public function deleteCableProvider($id)
    {

        $provider = CableProvider::find($id);
        if ($provider->delete()) {
            toast('Selected Provider Deleted Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * deactivateCableProvider
     *
     * @param id
     *
     * @return void
     */
    public function deactivateCableProvider($id)
    {

        $provider = CableProvider::find($id);
        $provider->status = "Deactivated";
        if ($provider->save()) {
            toast('Selected Provider Deactivated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * activateCableProvider
     *
     * @param id
     *
     * @return void
     */
    public function activateCableProvider($id)
    {

        $provider = CableProvider::find($id);
        $provider->status = "Active";
        if ($provider->save()) {
            toast('Selected Provider Activated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * dataProviders
     *
     * @return void
     */
    public function dataProviders()
    {
        $dataProviders = DataProvider::all();
        return view("data_providers", compact('dataProviders'));
    }

    /**
     * storeDataProvider
     *
     * @param Request request
     *
     * @return void
     */
    public function storeDataProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_name' => 'required',
            'service_id' => 'required',
            'transaction_fee' => 'required',
            'provider_logo' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = new DataProvider;
        $provider->biller = $request->provider_name;
        $provider->service_id = $request->service_id;
        $provider->fee = $request->transaction_fee;
        if ($request->has('provider_logo')) {
            $provider->biller_logo = Cloudinary::uploadFile($request->file('provider_logo')->getRealPath())->getSecurePath();
        }

        if ($provider->save()) {
            toast('Data Provider Added Successfully.', 'success');
            return back();

        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();

        }
    }

    /**
     * updateDataProvider
     *
     * @param Request request
     *
     * @return void
     */
    public function updateDataProvider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provider_id' => 'required',
            'provider_name' => 'required',
            'service_id' => 'required',
            'transaction_fee' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $provider = DataProvider::find($request->provider_id);
        $provider->biller = $request->provider_name;
        $provider->service_id = $request->service_id;
        $provider->fee = $request->transaction_fee;
        if ($request->has('provider_logo')) {
            $provider->biller_logo = Cloudinary::uploadFile($request->file('provider_logo')->getRealPath())->getSecurePath();
        }

        if ($provider->save()) {
            toast('Provider Information Updated Successfully.', 'success');
            return back();

        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();

        }
    }

    /**
     * deleteDataProvider
     *
     * @param id
     *
     * @return void
     */
    public function deleteDataProvider($id)
    {

        $provider = DataProvider::find($id);
        if ($provider->delete()) {
            toast('Selected Provider Deleted Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * deactivateDataProvider
     *
     * @param id
     *
     * @return void
     */

    public function deactivateDataProvider($id)
    {

        $provider = DataProvider::find($id);
        $provider->status = "Deactivated";
        if ($provider->save()) {
            toast('Selected Provider Deactivated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * activateDataProvider
     *
     * @param id
     *
     * @return void
     */

    public function activateDataProvider($id)
    {

        $provider = DataProvider::find($id);
        $provider->status = "Active";
        if ($provider->save()) {
            toast('Selected Provider Activated Successfully.', 'success');
            return back();
        } else {
            toast("Something went wrong! Please try again", 'error');
            return back();
        }

    }

    /**
     * utilityTransactions
     *
     * @return void
     */
    public function utilityTransactions()
    {
        $service = request()->service;
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->service) && !isset(request()->status)) {
            //Only Search has a value
            $lastRecord = UtilityTransactions::query()->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && isset(request()->service) && !isset(request()->status)) {
            //Search and service has a value
            $lastRecord = UtilityTransactions::query()->where("trx_type", $service)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("trx_type", $service)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && !isset(request()->service) && isset(request()->status)) {
            //Search and status has a value
            $lastRecord = UtilityTransactions::query()->where("status", $status)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("status", $status)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && isset(request()->service) && isset(request()->status)) {
            //Search, service and status has a value
            $lastRecord = UtilityTransactions::query()->where("trx_type", $service)->where("status", $status)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("trx_type", $service)->where("status", $status)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->service) && isset(request()->status)) {
            //Service and status has a value
            $lastRecord = UtilityTransactions::query()->where("trx_type", $service)->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("trx_type", $service)->where("status", $status)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->service) && !isset(request()->status)) {
            //Only Service has a value
            $lastRecord = UtilityTransactions::query()->where("trx_type", $service)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("trx_type", $service)->paginate(50);

        } else if (!isset(request()->search) && !isset(request()->service) && isset(request()->status)) {
            //Only Status has a value
            $lastRecord = UtilityTransactions::query()->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("status", $status)->paginate(50);

        } else {
            $lastRecord = UtilityTransactions::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::orderBy("id", "desc")->paginate(50);
        }
        return view("utility_transactions", compact("transactions", "lastRecord", "marker", "search", "service", "status"));
    }

    /**
     * BillPaymentTransactions
     *
     * @return void
     */
    public function BillPaymentTransactions()
    {
        $service = request()->service;
        $status = request()->status;
        $search = request()->search;
        if (isset(request()->search) && !isset(request()->service) && !isset(request()->status)) {
            //Only Search has a value
            $lastRecord = UtilityTransactions::query()->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && isset(request()->service) && !isset(request()->status)) {
            //Search and service has a value
            $lastRecord = UtilityTransactions::query()->where("trx_type", $service)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("trx_type", $service)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && !isset(request()->service) && isset(request()->status)) {
            //Search and status has a value
            $lastRecord = UtilityTransactions::query()->where("status", $status)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("status", $status)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (isset(request()->search) && isset(request()->service) && isset(request()->status)) {
            //Search, service and status has a value
            $lastRecord = UtilityTransactions::query()->where("trx_type", $service)->where("status", $status)->whereLike(["transaction_id"], $search)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("trx_type", $service)->where("status", $status)->whereLike(["transaction_id"], $search)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->service) && isset(request()->status)) {
            //Service and status has a value
            $lastRecord = UtilityTransactions::query()->where("trx_type", $service)->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("trx_type", $service)->where("status", $status)->paginate(50);

        } else if (!isset(request()->search) && isset(request()->service) && !isset(request()->status)) {
            //Only Service has a value
            $lastRecord = UtilityTransactions::query()->where("trx_type", $service)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("trx_type", $service)->paginate(50);

        } else if (!isset(request()->search) && !isset(request()->service) && isset(request()->status)) {
            //Only Status has a value
            $lastRecord = UtilityTransactions::query()->where("status", $status)->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::query()->where("status", $status)->paginate(50);

        } else {
            $lastRecord = UtilityTransactions::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $transactions = UtilityTransactions::orderBy("id", "desc")->paginate(50);
        }
        return view("bill_payment_transactions", compact("transactions", "lastRecord", "marker", "search", "service", "status"));
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

    public function getTenMarkers($lastRecord, $pageNum)
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
