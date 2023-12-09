<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->account_type == "business") {
            return redirect()->route("business.dashboard");
        } else if (Auth::user()->account_type == "artisan") {
            return redirect()->route("artisan.dashboard");
        } else {
            return redirect()->route("accountSelection");
        }
    }

}
