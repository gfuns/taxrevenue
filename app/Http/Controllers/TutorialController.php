<?php

namespace App\Http\Controllers;

use App\Models\TutorialVideos;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TutorialController extends Controller
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
     * newTutorial
     *
     * @return void
     */
    public function newTutorial()
    {
        return view("new_video");
    }

    /**
     * storeTutorial
     *
     * @param Request request
     *
     * @return void
     */
    public function storeTutorial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video_title' => 'required',
            'video_description' => 'required',
            'video_url' => 'required',
            'thumbnail' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $tutorial = new TutorialVideos;
        $tutorial->user_id = Auth::user()->id;
        $tutorial->video_title = $request->video_title;
        $tutorial->video_description = $request->video_description;
        $tutorial->video_url = $request->video_url;
        if ($request->has('thumbnail')) {
            $tutorial->thumbnail = Cloudinary::upload($request->file('thumbnail')->getRealPath())->getSecurePath();
        }

        if ($tutorial->save()) {
            toast('Tutorial Added Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while uploading tutorial", 'error');
            return back();
        }
    }

    /**
     * viewTutorials
     *
     * @return void
     */
    public function viewTutorials()
    {
        $search = request()->search;
        if (isset(request()->search)) {
            //Only search
            $lastRecord = TutorialVideos::where("video_title", "LIKE", '%' . $search . '%')->count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $tutorials = TutorialVideos::where("video_title", "LIKE", '%' . $search . '%')->paginate(50);

        } else {

            $lastRecord = TutorialVideos::count();
            $marker = $this->getMarkers($lastRecord, request()->page);
            $tutorials = TutorialVideos::paginate(50);
        }
        return view("video_tutorials", compact("tutorials", "lastRecord", "marker", "search"));
    }

    /**
     * updateTutorial
     *
     * @param Request request
     *
     * @return void
     */
    public function updateTutorial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tutorial_id' => 'required',
            'video_title' => 'required',
            'video_description' => 'required',
            'video_url' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errors = implode("<br>", $errors);
            toast($errors, 'error');
            return back();
        }

        $tutorial = TutorialVideos::find($request->tutorial_id);
        $tutorial->user_id = Auth::user()->id;
        $tutorial->video_title = $request->video_title;
        $tutorial->video_description = $request->video_description;
        $tutorial->video_url = $request->video_url;
        if ($request->has('thumbnail')) {
            $tutorial->thumbnail = Cloudinary::upload($request->file('thumbnail')->getRealPath())->getSecurePath();
        }

        if ($tutorial->save()) {
            toast('Tutorial Updated Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while updating tutorial", 'error');
            return back();
        }
    }

    /**
     * deleteTutorial
     *
     * @param mixed id
     *
     * @return void
     */
    public function deleteTutorial($id)
    {
        $tutorial = TutorialVideos::find($id);
        if ($tutorial->delete()) {
            toast('Tutorial Deleted Successfully.', 'success');
            return back();
        } else {
            toast("An error occured while deleting tutorial", 'error');
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
