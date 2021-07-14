<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function redirectTo(){
        $type = auth()->user()->type; 
        
        switch ($type) {
            case 'default':
                return '/home';
                break;
            case 'admin':
                return '/admin';
                break; 
            case 'doctor':
                return '/doctor';
                break; 
            case 'patient':
                return '/patient_view';
                break; 
            default:
                return '/login'; 
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
    }
}
