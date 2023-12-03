<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
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
     * newProduct
     *
     * @return void
     */
    public function newProduct()
    {
        return view("new_affiliate_product");
    }

    /**
     * storeProduct
     *
     * @param Request request
     *
     * @return void
     */
    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'currency' => 'required',
            'original_price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'affiliate_url' => 'required',
            'thumbnail' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $product = new Products;
        $product->user_id = Auth::user()->id;
        $product->product_name = $request->product_name;
        $product->currency = $request->currency;
        $product->original_price = $request->original_price;
        $product->discounted_price = $request->discounted_price;
        $product->affiliate_link = $request->affiliate_url;
        if ($request->has('thumbnail')) {
            $product->thumbnail = Cloudinary::upload($request->file('thumbnail')->getRealPath())->getSecurePath();
        }

        if ($product->save()) {
            toast('Affiliate Product Added Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while creating affiliate product", 'error');
            return back();
        }
    }

    /**
     * viewProducts
     *
     * @return void
     */
    public function viewProducts()
    {
        $search = request()->search;
        if (isset(request()->search)) {
            //Only search
            $lastRecord = Products::where("product_name", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $products = Products::where("product_name", "LIKE", '%' . $search . '%')->paginate(50);

        } else {

            $lastRecord = Products::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $products = Products::paginate(50);
        }
        return view("affiliate_products", compact("products", "lastRecord", "marker", "search"));
    }

    /**
     * updateProduct
     *
     * @param Request request
     *
     * @return void
     */
    public function updateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'product_name' => 'required',
            'currency' => 'required',
            'original_price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'affiliate_url' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $product = Products::find($request->product_id);
        $product->product_name = $request->product_name;
        $product->currency = $request->currency;
        $product->original_price = $request->original_price;
        $product->discounted_price = $request->discounted_price;
        $product->affiliate_link = $request->affiliate_url;
        if ($request->has('thumbnail')) {
            $product->thumbnail = Cloudinary::upload($request->file('thumbnail')->getRealPath())->getSecurePath();
        }

        if ($product->save()) {
            toast('Affiliate Product Added Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while creating affiliate product", 'error');
            return back();
        }
    }

    /**
     * deleteProduct
     *
     * @param mixed id
     *
     * @return void
     */
    public function deleteProduct($id)
    {
        $product = Products::find($id);
        if ($product->delete()) {
            toast('Product Deleted Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while deleting product", 'error');
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
