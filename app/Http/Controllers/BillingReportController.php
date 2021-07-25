<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Patient;
use App\Model\PatientBillingCharge;
use App\Model\PatientBillingPayment;

class BillingReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patient_balance_report($patient_id)
    {
        $patient = Patient::find($patient_id);
        $invoices = PatientBillingCharge::where('patient_id', $patient_id)->get();
        $payments = PatientBillingPayment::where('patient_id', $patient_id)->get();

        return view('report.patient_balance')
                    ->with('patient', $patient)
                    ->with('invoices', $invoices)
                    ->with('payments', $payments);
    }
}
