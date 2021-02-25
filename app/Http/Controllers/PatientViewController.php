<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Hash;

class PatientViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change_password()
    {
    	$username = auth()->user()->username;

    	return view('patient_view.auth.change_password')->with('username', $username);
    }

    public function update_password(Request $request)
    {
    	$request->validate([
		    'new_password' => ['required', 'string', 'max:255', 'alpha_dash']
		]);


    	$user = User::where('username', $request->username)->first();

    	if(!Hash::check($request->password, $user->password)){
	        return back()->withErrors('The password you have entered does not match your current one.');
	    }else{
	        $user->password = Hash::make($request->new_password);
      		$user->save();

      		return back()->with('success','Password successfully changed!');
	    }
    }
}
