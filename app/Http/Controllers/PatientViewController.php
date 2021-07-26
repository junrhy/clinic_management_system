<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Patient;
use App\Model\Clinic;
use App\Model\Doctor;
use App\Model\Service;
use App\Model\PatientDetail;
use App\User;

use Hash;
use Auth;
use DB;
use DateTime;

class PatientViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change_password()
    {
    	$username = auth()->user()->username;

    	return view('patient_view.auth.change_password')->with('username', $username);
    }

    public function update_password(Request $request)
    {
    	$request->validate([
		    'new_password' => ['required', 'string', 'max:255', 'alpha_dash']
		]);


    	$user = User::where('username', $request->username)->first();

    	if(!Hash::check($request->password, $user->password)){
	        return back()->withErrors('The password you have entered does not match your current one.');
	    }else{
	        $user->password = Hash::make($request->new_password);
      		$user->save();

      		return back()->with('success','Password successfully changed!');
	    }
    }

    public function request_appointment()
    {
        $patient = Patient::where('user_id', Auth::user()->id)->first();

        $clinics = Clinic::where('client_id', Auth::user()->client_id)->orderBy('name', 'asc')->get();

        $doctors = Doctor::select(DB::raw("CONCAT(first_name,' ',last_name) AS fullname"),'id')
                            ->where('client_id', Auth::user()->client_id)
                            ->orderBy('first_name', 'asc')
                            ->get();

        $services = Service::where('client_id', Auth::user()->client_id)->orderBy('name', 'asc')->get();

        return view('patient_view.request_appointment')
                    ->with('patient', $patient)
                    ->with('clinics', $clinics)
                    ->with('doctors', $doctors)
                    ->with('services', $services);
    }

    public function submit_appointment_request(Request $request)
    {
        $request->validate([
            'date_scheduled' => ['required'],
            'time_scheduled' => ['required'],
            'clinic_id' => ['required'],
            'doctor_id' => ['required'],
            'notes' => ['required']
        ]);

        $clinic = Clinic::find($request->clinic_id);
        $doctor = Doctor::find($request->doctor_id);

        $patient_detail = new PatientDetail;
        $patient_detail->client_id = Auth::user()->client_id;
        $patient_detail->patient_id = $request->patient_id;
        $patient_detail->clinic_id = $clinic->id;
        $patient_detail->doctor_id = $doctor->id;
        $patient_detail->clinic = $clinic->name;
        $patient_detail->doctor = $doctor->first_name .' '. $doctor->last_name;
        $patient_detail->notes = $request->notes;
        $patient_detail->is_schedule_request = true;
        $patient_detail->is_scheduled = true;
        $patient_detail->date_scheduled = date('Y-m-d', strtotime($request->date_scheduled));
        $patient_detail->time_scheduled = DateTime::createFromFormat('H:i a', $request->time_scheduled);
        $patient_detail->status = 'Open';
        $patient_detail->save();

        return back()->with('success','Appointment request successfully submitted!');
    }
}
