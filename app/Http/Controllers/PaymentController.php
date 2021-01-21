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
                            ->where('last_name', 'like', '%' . $request->namelist . '%')
                            ->orderBy('last_name', 'asc')
                            ->paginate(30);

        return view('payment.index')
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

        return view('payment._table_data')
              ->with('patients', $patients);
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
