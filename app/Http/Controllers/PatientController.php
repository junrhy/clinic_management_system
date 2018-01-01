<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Patient;

use Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::where('client_id', Auth::user()->client_id)->get();

        return view('patient.index')
              ->with('patients', $patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = app('pragmarx.countries');
        $countries_names = $countries->all()->pluck('name.common', 'name.common')->toArray();
        array_unshift($countries_names, null);

        return view('patient.create')
                  ->with('countries', $countries_names);
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
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->name_of_father = $request->name_of_father;
        $patient->name_of_mother = $request->name_of_mother;
        $patient->mother_maiden_name = $request->mother_maiden_name;
        $patient->age = $request->age;
        $patient->gender = $request->gender != 0 ? $request->gender : null;
        $patient->civil_status = $request->civil_status != 0 ? $request->civil_status : null;
        $patient->number_of_children = $request->number_of_children;
        $patient->email = $request->email;
        $patient->contact_number = $request->contact_number;
        $patient->address1 = $request->address1;
        $patient->address2 = $request->address2;
        $patient->town = $request->town;
        $patient->province = $request->province;
        $patient->country = $request->country != 0 ? $request->country : null;
        $patient->occupation = $request->occupation;
        $patient->company_name = $request->company_name;
        $patient->company_address = $request->company_address;
        $patient->company_email = $request->company_email;
        $patient->company_contact_number = $request->company_contact_number;
        $patient->emergency_contact_name1 = $request->emergency_contact_name1;
        $patient->emergency_contact_number1 = $request->emergency_contact_number1;
        $patient->emergency_contact_name2 = $request->emergency_contact_name2;
        $patient->emergency_contact_number2 = $request->emergency_contact_number2;
        $patient->emergency_contact_name3 = $request->emergency_contact_name3;
        $patient->emergency_contact_number3 = $request->emergency_contact_number3;
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

        return view('patient.show')
                ->with('patient', $patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = app('pragmarx.countries');
        $countries_names = $countries->all()->pluck('name.common', 'name.common')->toArray();
        array_unshift($countries_names, null);

        $patient = Patient::find($id);

        return view('patient.edit')
                ->with('patient', $patient)
                ->with('countries', $countries_names);

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
        $patient->middle_name = $request->middle_name;
        $patient->last_name = $request->last_name;
        $patient->name_of_father = $request->name_of_father;
        $patient->name_of_mother = $request->name_of_mother;
        $patient->mother_maiden_name = $request->mother_maiden_name;
        $patient->age = $request->age;
        $patient->gender = $request->gender != 0 ? $request->gender : null;
        $patient->civil_status = $request->civil_status != 0 ? $request->civil_status : null;
        $patient->number_of_children = $request->number_of_children;
        $patient->email = $request->email;
        $patient->contact_number = $request->contact_number;
        $patient->address1 = $request->address1;
        $patient->address2 = $request->address2;
        $patient->town = $request->town;
        $patient->province = $request->province;
        $patient->country = $request->country != 0 ? $request->country : null;
        $patient->occupation = $request->occupation;
        $patient->company_name = $request->company_name;
        $patient->company_address = $request->company_address;
        $patient->company_email = $request->company_email;
        $patient->company_contact_number = $request->company_contact_number;
        $patient->emergency_contact_name1 = $request->emergency_contact_name1;
        $patient->emergency_contact_number1 = $request->emergency_contact_number1;
        $patient->emergency_contact_name2 = $request->emergency_contact_name2;
        $patient->emergency_contact_number2 = $request->emergency_contact_number2;
        $patient->emergency_contact_name3 = $request->emergency_contact_name3;
        $patient->emergency_contact_number3 = $request->emergency_contact_number3;
        $patient->save();

        return redirect('patient');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();

        return redirect('patient');
    }
}
