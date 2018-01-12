<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Doctor;

use Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::where('client_id', Auth::user()->client_id)->get();

        return view('doctor.index')
              ->with('doctors', $doctors);
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

        return view('doctor.create')
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
        $doctor = new Doctor;
        $doctor->client_id = Auth::user()->client_id;
        $doctor->first_name = $request->first_name;
        $doctor->middle_name = $request->middle_name;
        $doctor->last_name = $request->last_name;
        $doctor->age = $request->age;
        $doctor->gender = $request->gender;
        $doctor->civil_status = $request->civil_status;
        $doctor->email = $request->email;
        $doctor->contact_number = $request->contact_number;
        $doctor->address1 = $request->address1;
        $doctor->address2 = $request->address2;
        $doctor->town = $request->town;
        $doctor->province = $request->province;
        $doctor->country = $request->country != '0' ? $request->country : null;
        $doctor->save();

        return redirect('doctor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);

        return view('doctor.show')
                ->with('doctor', $doctor);
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

        $doctor = Doctor::find($id);

        return view('doctor.edit')
                ->with('doctor', $doctor)
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
        $doctor = Doctor::find($id);
        $doctor->first_name = $request->first_name;
        $doctor->middle_name = $request->middle_name;
        $doctor->last_name = $request->last_name;
        $doctor->age = $request->age;
        $doctor->gender = $request->gender;
        $doctor->civil_status = $request->civil_status;
        $doctor->email = $request->email;
        $doctor->contact_number = $request->contact_number;
        $doctor->address1 = $request->address1;
        $doctor->address2 = $request->address2;
        $doctor->town = $request->town;
        $doctor->province = $request->province;
        $doctor->country = $request->country;
        $doctor->save();

        return redirect('doctor');
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

        $doctor = Doctor::find($id);
        $doctor->delete();

        return redirect('doctor');
    }
}
