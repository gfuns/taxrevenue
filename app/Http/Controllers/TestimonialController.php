<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
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
     * newTestimonial
     *
     * @return void
     */
    public function newTestimonial()
    {
        return view('new_testimonial');
    }

    /**
     * storeTestimonial
     *
     * @param Request request
     *
     * @return void
     */
    public function storeTestimonial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'testifier_name' => 'required',
            'testifier_occupation' => 'required',
            'testifier_photo' => 'required',
            'testimony' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $testimony = new Testimonial;
        $testimony->name = $request->testifier_name;
        $testimony->occupation = $request->testifier_occupation;
        $testimony->testimony = $request->testimony;
        if ($request->has('testifier_photo')) {
            $testimony->photo = Cloudinary::upload($request->file('testifier_photo')->getRealPath())->getSecurePath();
        }

        if ($testimony->save()) {
            toast('Testimonial Added Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while adding testimonial", 'error');
            return back();
        }
    }

    /**
     * viewTestimonials
     *
     * @return void
     */
    public function viewTestimonials()
    {
        $search = request()->search;
        if (isset(request()->search)) {
            $lastRecord = Testimonial::where("name", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $testimonials = Testimonial::orderBy("id", "desc")->where("name", "LIKE", '%' . $search . '%')->paginate(50);
        } else {
            $lastRecord = Testimonial::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $testimonials = Testimonial::orderBy("id", "desc")->paginate(50);
        }
        return view('testimonials', compact('testimonials', 'marker', 'lastRecord', 'search'));
    }

    /**
     * editTestimonial
     *
     * @param mixed id
     *
     * @return void
     */
    public function editTestimonial($id)
    {
        $testimonial = Testimonial::find($id);
        return view('edit_testimonial', compact('testimonial'));
    }

    /**
     * updateTestimonial
     *
     * @param Request request
     *
     * @return void
     */
    public function updateTestimonial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'testimonial_id' => 'required',
            'testifier_name' => 'required',
            'testifier_occupation' => 'required',
            'testimony' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $testimony = Testimonial::find($request->testimonial_id);
        $testimony->name = $request->testifier_name;
        $testimony->occupation = $request->testifier_occupation;
        $testimony->testimony = $request->testimony;
        if ($request->has('testifier_photo')) {
            $testimony->photo = Cloudinary::upload($request->file('testifier_photo')->getRealPath())->getSecurePath();
        }

        if ($testimony->save()) {
            toast('Testimonial Updated Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while updating testimonial", 'error');
            return back();
        }
    }

    /**
     * deleteTestimonial
     *
     * @param mixed id
     *
     * @return void
     */
    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::find($id);
        if ($testimonial->delete()) {
            toast('Testimonial Deleted Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while deleting testimonial", 'error');
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
