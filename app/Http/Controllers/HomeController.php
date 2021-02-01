<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Model\Clinic;
use App\Model\Doctor;
use App\Model\Patient;
use App\Model\FeatureUser;

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
        $this->middleware('is_default');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patient_count = Patient::where('client_id', Auth::user()->client_id)->count();
        $clinic_count = Clinic::where('client_id', Auth::user()->client_id)->count();
        $doctor_count = Doctor::where('client_id', Auth::user()->client_id)->count();

        return view('home')
                ->with('patient_count', $patient_count)
                ->with('clinic_count', $clinic_count)
                ->with('doctor_count', $doctor_count);
    }

}
