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

    public function edit($id)
    {
        $client = Client::find($id);

        return view('admin.client.edit')
                ->with('client', $client);
    }

    public function update(Request $request, $id)
    {
      $client = Client::find($id);
      $client->app_license_no = $request->app_license_no;
      $client->is_active = $request->is_active;
      $client->is_suspended = $request->is_suspended;
      $client->save();

      return redirect('/admin/clients');
    }
}
