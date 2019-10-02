<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Role;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(Role::select('name')->where('client_id', Auth::user()->client_id)->get()->toArray());

        return view('home');
    }

}
