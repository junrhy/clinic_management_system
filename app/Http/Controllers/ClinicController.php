<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Clinic;

use Auth;

class ClinicController extends Controller
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
    public function index()
    {
        $clinics = Clinic::where('client_id', Auth::user()->client_id)->get();

        return view('clinic.index')
              ->with('clinics', $clinics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clinic = new Clinic;
        $clinic->client_id = Auth::user()->client_id;
        $clinic->name = $request->name;
        $clinic->address = $request->address;
        $clinic->save();

        return redirect('clinic');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clinic = Clinic::find($id);

        return view('clinic.show')
                ->with('clinic', $clinic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clinic = Clinic::find($id);

        return view('clinic.edit')
                ->with('clinic', $clinic);
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
      $clinic = Clinic::find($id);
      $clinic->name = $request->name;
      $clinic->address = $request->address;
      $clinic->save();

      return redirect('clinic');
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

        $clinic = Clinic::find($id);
        $clinic->delete();

        return redirect('clinic');
    }
}
