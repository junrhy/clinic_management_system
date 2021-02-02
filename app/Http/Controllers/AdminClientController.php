<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Client;

class AdminClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$clients = Client::all();

    	return view('admin.client.index')
    				->with('clients', $clients);
    }
}
