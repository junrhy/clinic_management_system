<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['register', 'create_admin_user'] ]);
    }
    
    public function register()
    {
    	return view('admin.auth.register');
    }

    public function create_admin_user(Request $request)
    {
    	$validated = $request->validate([
	        'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
	    ]);

    	$user = User::create([
            'client_id' => 0,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'type'      => User::ADMIN_TYPE,
            'is_client' => false,
        ]);

        return redirect('/admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function change_password()
    {
        $username = auth()->user()->username;

        return view('admin.auth.change_password')->with('username', $username);
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
