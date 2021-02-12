<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Model\PatientDetail;
use App\Model\Patient;
use App\Model\Clinic;
use App\Model\Doctor;
use App\Model\Service;

use DB;
use Auth;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $client_id = $this->get_client_id();

        $patients = Patient::select(DB::raw("CONCAT(last_name,', ',first_name) AS fullname"),'id')
                            ->where('client_id', $client_id)
                            ->orderBy('last_name', 'asc')
                            ->pluck('fullname', 'id');

        $clinics = Clinic::where('client_id', $client_id)->pluck('name', 'id');

        $doctors = Doctor::select(DB::raw("CONCAT(first_name,' ',last_name) AS fullname"),'id')
                            ->where('client_id', $client_id)
                            ->pluck('fullname', 'id');

        $services = Service::where('client_id', $client_id)->pluck('name', 'name');

        return view('calendar.index')
                    ->with('patients', $patients)
                    ->with('clinics', $clinics)
                    ->with('doctors', $doctors)
                    ->with('services', $services);
    }

    public function scheduled_patients(Request $request)
    {
        $scheduled = PatientDetail::where('client_id', Auth::user()->client_id)
                                ->where('clinic_id', $request->clinic_id)
                                ->whereDate('date_scheduled', $request->date)
                                ->where('status', $request->status)
                                ->orderBy('time_scheduled', 'asc')
                                ->get();

        return view('calendar._scheduled_patients')
                    ->with('scheduled', $scheduled);
    }

    private function get_client_id()
    {
        $client_id = Auth::user()->client->id;

        return $client_id;
    }

    public function get_all_appointments(Request $request)
    {
        $appointments = PatientDetail::select('date_scheduled', DB::raw('count(*) as total'))
                                ->where('client_id', Auth::user()->client_id)
                                ->where('clinic_id', $request->clinic_id)
                                ->whereIn('status', ['Open', 'In Progress'])
                                ->groupBy('date_scheduled')
                                ->get();

        return response()->json($appointments);
    }
}
