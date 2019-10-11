<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;

use App\User;
use App\Model\Client;
use App\Model\Patient;

use Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function business_information()
    {
        $client = auth()->user()->client;

        return view('account.business_information')->with('client', $client);
    }

    public function update_business_information(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->contact = $request->contact;
        $client->save();
        
        return back()->with('success','Business information successfully updated!');
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

    public function success(Request $request)
    {
        // $client = Client::find(Auth::user()->client_id);
        // $client->account_type = 'business';
        // $client->save();

        return view('account.success');
    }

    public function cancel()
    {
        return view('account.cancel');
    }
}
