<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Patient;
use App\Model\PatientBillingCharge;

use Auth;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $patients = Patient::where('client_id', Auth::user()->client_id)
                            ->where('last_name', 'like', $request->namelist . '%')
                            ->orderBy('last_name', 'asc')
                            ->paginate(30);

        return view('invoice.index')
              ->with('patients', $patients)
              ->with('namelist', $request->namelist);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $multiple_keyword = explode(' ', $request->keyword);

        $patients = Patient::where('client_id', Auth::user()->client_id)
                            ->whereIn('first_name', $multiple_keyword)
                            ->orWhereIn('last_name', $multiple_keyword)
                            ->orWhereIn('contact_number', $multiple_keyword)
                            ->orWhere('first_name', 'like', '%' . $keyword . '%')
                            ->orWhere('last_name', 'like', '%' . $keyword . '%')
                            ->orWhere('contact_number', 'like', '%' . $keyword . '%')
                            ->paginate(30);

        return view('invoice._table_data')
              ->with('patients', $patients);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        $billing_charges = PatientBillingCharge::where('patient_id', $patient->id)->get();

        return view('invoice.show')
        		->with('patient', $patient)
                ->with('billing_charges', $billing_charges);
    }

    public function create_billing_charge(Request $request)
    {
        $billing_charge = new PatientBillingCharge;
        $billing_charge->client_id = Auth::user()->client_id;
        $billing_charge->patient_id = $request->patient_id;
        $billing_charge->description = $request->description;
        $billing_charge->amount = $request->amount;
        $billing_charge->save();
    }

    public function delete_patient_charge(Request $request, $id)
    {
        $billing_charge = PatientBillingCharge::find($id);
        $patient_id = $billing_charge->patient_id;

        $billing_charge->delete();
    }
}
