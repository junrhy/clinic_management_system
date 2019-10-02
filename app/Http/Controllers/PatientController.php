<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Patient;
use App\Model\PatientDetail;
use App\Model\PatientBillingCharge;
use App\Model\PatientBillingPayment;

use Auth;
use DateTime;

class PatientController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patients = Patient::where('client_id', Auth::user()->client_id)
                            ->where('first_name', 'like', $request->namelist . '%')
                            ->orderBy('first_name', 'asc')
                            ->paginate(30);

        return view('patient.index')
              ->with('patients', $patients)
              ->with('namelist', $request->namelist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = new Patient;
        $patient->client_id = Auth::user()->client_id;
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->gender = $request->gender;
        $patient->email = $request->email;
        $patient->contact_number = $request->contact_number;
        $patient->save();

        return redirect('patient');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        $patient_details = PatientDetail::where('patient_id', $patient->id)->where('is_archived', false)->get();
        $archived_details = PatientDetail::where('patient_id', $patient->id)->where('is_archived', true)->get();
        $billing_charges = PatientBillingCharge::where('patient_id', $patient->id)->get();
        $billing_payments = PatientBillingPayment::where('patient_id', $patient->id)->get();

        return view('patient.show')
                ->with('patient', $patient)
                ->with('details', $patient_details)
                ->with('archived_details', $archived_details)
                ->with('billing_charges', $billing_charges)
                ->with('billing_payments', $billing_payments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);

        return view('patient.edit')
                ->with('patient', $patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->gender = $request->gender;
        $patient->email = $request->email;
        $patient->contact_number = $request->contact_number;
        $patient->save();

        return redirect('patient');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles(['Client User', 'Admin User']);

        $patient = Patient::find($id);
        $patient_id = $patient->id;

        $patient->delete();
        PatientDetail::where('patient_id', $patient_id)->delete();
        PatientBillingCharge::where('patient_id', $patient_id)->delete();
        PatientBillingPayment::where('patient_id', $patient_id)->delete();
    }

    public function create_patient_detail(Request $request)
    {
        $patient_detail = new PatientDetail;
        $patient_detail->client_id = Auth::user()->client_id;
        $patient_detail->patient_id = $request->patient_id;
        $patient_detail->detail = nl2br($request->detail);
        $patient_detail->is_scheduled = $request->date_scheduled != '' ? true : false;
        $patient_detail->date_scheduled = $request->date_scheduled != '' ? date('Y-m-d', strtotime($request->date_scheduled)) : null;
        $patient_detail->time_scheduled = DateTime::createFromFormat('H:i a', $request->time_scheduled);
        $patient_detail->save();
    }

    public function delete_patient_detail(Request $request, $id)
    {
        $patient_detail = PatientDetail::find($id);
        $patient_id = $patient_detail->patient_id;

        $patient_detail->delete();
    }

    public function archive_patient_detail($id)
    {
        $patient_detail = PatientDetail::find($id);
        $patient_detail->is_archived = true;
        $patient_detail->save();
    }

    public function unarchive_patient_detail($id)
    {
        $patient_detail = PatientDetail::find($id);
        $patient_detail->is_archived = false;
        $patient_detail->save();
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
