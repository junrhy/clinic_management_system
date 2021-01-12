<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Patient;
use App\Model\PatientBillingPayment;

use Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $patients = Patient::where('client_id', Auth::user()->client_id)
                            ->where('first_name', 'like', $request->namelist . '%')
                            ->orderBy('first_name', 'asc')
                            ->paginate(30);

        return view('payment.index')
              ->with('patients', $patients)
              ->with('namelist', $request->namelist);
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        $billing_payments = PatientBillingPayment::where('patient_id', $patient->id)->get();

        return view('payment.show')
                ->with('patient', $patient)
                ->with('billing_payments', $billing_payments);
    }

    public function create_billing_payment(Request $request)
    {
        $billing_payment = new PatientBillingPayment;
        $billing_payment->client_id = Auth::user()->client_id;
        $billing_payment->patient_id = $request->patient_id;
        $billing_payment->description = $request->description;
        $billing_payment->amount = $request->amount;
        $billing_payment->save();
    }

    public function delete_patient_payment(Request $request, $id)
    {
        $billing_payment = PatientBillingPayment::find($id);
        $patient_id = $billing_payment->patient_id;

        $billing_payment->delete();
    }
}
