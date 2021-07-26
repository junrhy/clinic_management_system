<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Model\Clinic;
use App\Model\Doctor;
use App\Model\Service;
use App\Model\Patient;
use App\Model\PatientDetail;
use App\Model\Domain;
use App\Model\Subscription;
use App\Model\Client;

use Carbon\Carbon;

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
        if( Auth::check() ) {
            $user = User::find(Auth::user()->id);
            $user->last_active_at = Carbon::now()->toDateTimeString();
            $user->save();
        }

        $subscriptions = Subscription::where('client_id', Auth::user()->client_id)->where('is_active', true)->get();

        if (count($subscriptions) == 0) {
            $client = Client::find(Auth::user()->client_id);
            $client->account_type = 'free';
            $client->save();
        }

        $domain_name = $request->gethost();
        $domains = Domain::where('client_id', Auth::user()->client_id)->get();

        $patients = Patient::where('client_id', Auth::user()->client_id)->get();
        $clinics = Clinic::where('client_id', Auth::user()->client_id)->get();
        $doctors = Doctor::where('client_id', Auth::user()->client_id)->get();
        $services = Service::where('client_id', Auth::user()->client_id)->get();

        $patient_count = $patients->count();
        $clinic_count = $clinics->count();
        $doctor_count = $doctors->count();
        $service_count = $services->count();

        return view('home')
                ->with('domains', $domains)
                ->with('patients', $patients)
                ->with('clinics', $clinics)
                ->with('doctors', $doctors)
                ->with('patient_count', $patient_count)
                ->with('clinic_count', $clinic_count)
                ->with('doctor_count', $doctor_count)
                ->with('service_count', $service_count);
    }

}
