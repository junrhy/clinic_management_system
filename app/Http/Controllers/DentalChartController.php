<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Patient;
use App\Model\DentalChart;
use App\Model\Domain;

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

        $patients = Patient::select(DB::raw("CONCAT(last_name,', ',first_name) AS fullname"),'id')
                        ->where('client_id', Auth::user()->client_id)
                        ->orderBy('last_name', 'asc')
                        ->get();

        $dental_records = DentalChart::where('patient_id', $patient_id)->get();

        $tooth_numbers = $dental_records->pluck('tooth_number')->toArray();

        $patient_name = Patient::find($patient_id);

		return view('dentalchart.index')
                    ->with('dental_records', $dental_records)
                    ->with('tooth_numbers', $tooth_numbers)
                    ->with('patients', $patients)
                    ->with('patient_id', $patient_id)
                    ->with('patient_name', $patient_name);
	}

    public function get_attributes(Request $request)
    {
        $attributes = DentalChart::where('patient_id', $request->patient_id)
                            ->where('tooth_number', $request->tooth_number)
                            ->where('client_id', Auth::user()->client_id)
                            ->get();

        return response()
            ->json($attributes);
    }

    public function get_patient_attributes(Request $request)
    {
        $attributes = DentalChart::where('patient_id', $request->patient_id)
                            ->where('client_id', Auth::user()->client_id)
                            ->get();

        return response()
            ->json($attributes);
    }

    public function update_attribute(Request $request)
    {
        if (in_array($request->attribute, ['add-x', 'add-vline', 'add-circle'])) {
            $attributes = DentalChart::where('patient_id', $request->patient_id)
                                ->where('tooth_number', $request->tooth_number)
                                ->whereIn('attribute', ['add-x', 'add-vline', 'add-circle'])
                                ->where('client_id', Auth::user()->client_id)
                                ->get();

            if (count($attributes) > 0) {
                DentalChart::where('patient_id', $request->patient_id)
                                ->where('tooth_number', $request->tooth_number)
                                ->whereIn('attribute', ['add-x', 'add-vline', 'add-circle'])
                                ->where('client_id', Auth::user()->client_id)
                                ->delete();
            }
        }

        $isApply = $request->is_apply;

        if ($isApply == "yes") {
            $dentalchart = new DentalChart;
            $dentalchart->client_id = Auth::user()->client_id;
            $dentalchart->patient_id = $request->patient_id;
            $dentalchart->tooth_number = $request->tooth_number;
            $dentalchart->attribute = $request->attribute;
                
            $dentalchart->save();
        } else {
            if (in_array($request->attribute, ['filling-top', 'filling-left', 'filling-bottom', 'filling-right', 'filling-center'])) {
                $dentalchart = DentalChart::where('patient_id', $request->patient_id)
                                    ->where('tooth_number', $request->tooth_number)
                                    ->where('attribute', $request->attribute)
                                    ->where('client_id', Auth::user()->client_id)
                                    ->first();

                $dentalchart->delete();
            }
        }
    }
}
