<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Model\PatientDetail;
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

        return view('calendar.index');
    }

    public function scheduled_patients(Request $request)
    {
        $scheduled = PatientDetail::where('client_id', Auth::user()->client_id)
                                ->whereDate('date_scheduled', $request->date)
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
}
