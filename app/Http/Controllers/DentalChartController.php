<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Patient;
use App\Model\DentalChart;

use Auth;
use DB;

class DentalChartController extends Controller
{
    public function __construct()
	{
	    $this->middleware('auth');
	}

	public function index(Request $request)
	{
        $patient_id = isset($request->patient_id) ? $request->patient_id : 0;

        $patients = Patient::select(DB::raw("CONCAT(first_name,' ',last_name) AS fullname"),'id')
                        ->where('client_id', Auth::user()->client_id)
                        ->get();

        $dental_records = DentalChart::where('patient_id', $patient_id)->get();

        $tooth_numbers = $dental_records->pluck('tooth_number')->toArray();

        $patient_name = Patient::find($patient_id);

		return view('dentalchart.index')
                    ->with('dental_records', $dental_records)
                    ->with('tooth_numbers', $tooth_numbers)
                    ->with('patients', $patients)
                    ->with('patient_name', $patient_name);
	}

    public function store(Request $request)
    {
    	
        $dentalchart = new DentalChart;
        $dentalchart->client_id = Auth::user()->client_id;
        $dentalchart->patient_id = $request->patient_id;
        $dentalchart->tooth_number = $request->tooth_number;
        $dentalchart->diagnosis = $request->diagnosis;
        $dentalchart->treatment = $request->treatment;
        $dentalchart->price = $request->price;
            
        $dentalchart->save();
    }

    public function destroy($id)
    {
        $dental_record = DentalChart::find($id);
        $dental_record->delete();
    }
}
