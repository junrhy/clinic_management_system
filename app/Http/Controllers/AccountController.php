<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;

use App\User;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change_password()
    {
    	$email = auth()->user()->email;

        return view('account.change_password')->with('email', $email);
    }

    public function update_password(Request $request)
    {
    	$request->validate([
		    'new_password' => ['required', 'string', 'max:255', 'alpha_dash']
		]);


    	$user = User::where('email', $request->email)->first();

    	if(!Hash::check($request->password, $user->password)){
	        return back()->withErrors('The password you have entered does not match your current one.');
	    }else{
	        $user->password = Hash::make($request->new_password);
      		$user->save();

      		return back()->with('success','Password successfully changed!');
	    }
    }
}
