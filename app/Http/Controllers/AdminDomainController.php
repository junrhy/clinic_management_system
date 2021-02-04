<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Domain;

class AdminDomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$domains = Domain::all();

    	return view('admin.domain.index')
    				->with('domains', $domains);
    }
}
