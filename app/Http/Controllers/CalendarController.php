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
                                ->whereNull('is_schedule_request')
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
        $overview = PatientDetail::select('date_scheduled', 
                                    DB::raw('count(*) as total'), 
                                    DB::raw("SUM(case when status = 'Open' then 1 else 0 end) as open_total"),
                                    DB::raw("SUM(case when status = 'In Progress' then 1 else 0 end) as in_progress_total") )
                                ->where('client_id', Auth::user()->client_id)
                                ->where('clinic_id', $request->clinic_id)
                                ->whereNull('is_schedule_request')
                                ->whereIn('status', ['Open', 'In Progress'])
                                ->groupBy('date_scheduled')
                                ->get();

        return response()->json([
                                'overview' => $overview
                            ]);
    }

    public function get_appointment_status_count(Request $request)
    {
        $overview = PatientDetail::select('date_scheduled', 
                                    DB::raw('count(*) as total'), 
                                    DB::raw("SUM(case when status = 'Open' then 1 else 0 end) as open_total"),
                                    DB::raw("SUM(case when status = 'In Progress' then 1 else 0 end) as in_progress_total") )
                                ->where('client_id', Auth::user()->client_id)
                                ->where('clinic_id', $request->clinic_id)
                                ->where('date_scheduled', $request->date)
                                ->whereNull('is_schedule_request')
                                ->whereIn('status', ['Open', 'In Progress'])
                                ->groupBy('date_scheduled')
                                ->get();

        return response()->json($overview);
    }

    public function show_appointment_requests(Request $request)
    {
        $appointment_requests = PatientDetail::where('client_id', Auth::user()->client_id)
                                        ->where('is_schedule_request', true)
                                        ->get();

        return view('calendar.appointment_requests')
                    ->with('appointment_requests', $appointment_requests);
    }

    public function appointment_request_approved(Request $request)
    {
        $appointment_request = PatientDetail::find($request->id);
        $appointment_request->is_schedule_request = null;
        $appointment_request->save();
    }

    public function appointment_request_denied($id)
    {
        $appointment_request = PatientDetail::find($id);
        $appointment_request->delete();
    }
}
