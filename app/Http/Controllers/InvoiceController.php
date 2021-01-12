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
                            ->where('first_name', 'like', $request->namelist . '%')
                            ->orderBy('first_name', 'asc')
                            ->paginate(30);

        return view('invoice.index')
              ->with('patients', $patients)
              ->with('namelist', $request->namelist);
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
