<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Model\Patient;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patient_count = Patient::where('client_id', Auth::user()->client_id)->count();

        return view('home')
                ->with('patient_count', $patient_count);
    }

}
