<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Therapist;

use Auth;

class TherapistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $therapists = Therapist::where('client_id', Auth::user()->client_id)->get();

        return view('therapist.index')
              ->with('therapists', $therapists);
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

        return view('therapist.create')
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
        $therapist = new Therapist;
        $therapist->client_id = Auth::user()->client_id;
        $therapist->first_name = $request->first_name;
        $therapist->middle_name = $request->middle_name;
        $therapist->last_name = $request->last_name;
        $therapist->age = $request->age;
        $therapist->gender = $request->gender;
        $therapist->civil_status = $request->civil_status;
        $therapist->email = $request->email;
        $therapist->contact_number = $request->contact_number;
        $therapist->address1 = $request->address1;
        $therapist->address2 = $request->address2;
        $therapist->town = $request->town;
        $therapist->province = $request->province;
        $therapist->country = $request->country != '0' ? $request->country : null;
        $therapist->save();

        return redirect('therapist');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $therapist = Therapist::find($id);

        return view('therapist.show')
                ->with('therapist', $therapist);
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

        $therapist = Therapist::find($id);

        return view('therapist.edit')
                ->with('therapist', $therapist)
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
        $therapist = Therapist::find($id);
        $therapist->first_name = $request->first_name;
        $therapist->middle_name = $request->middle_name;
        $therapist->last_name = $request->last_name;
        $therapist->age = $request->age;
        $therapist->gender = $request->gender;
        $therapist->civil_status = $request->civil_status;
        $therapist->email = $request->email;
        $therapist->contact_number = $request->contact_number;
        $therapist->address1 = $request->address1;
        $therapist->address2 = $request->address2;
        $therapist->town = $request->town;
        $therapist->province = $request->province;
        $therapist->country = $request->country;
        $therapist->save();

        return redirect('therapist');
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

        $therapist = Therapist::find($id);
        $therapist->delete();

        return redirect('therapist');
    }
}
