<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Client;
use App\Model\DisconnectionReason;

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
      $client->is_vip = $request->is_vip;
      $client->is_active = $request->is_active;
      $client->is_suspended = $request->is_suspended;
      $client->is_disconnected = $request->is_disconnected;
      $client->save();

      if ($request->is_disconnected == 0) {
        DisconnectionReason::where('client_id', $id)->delete();
      }

      return redirect('/admin/clients');
    }

    public function show_disconnection_reasons($id)
    {
      $client = Client::find($id);
      $disconnection_reasons = DisconnectionReason::where('client_id', $id)->get();

      return view('admin.client.show_disconnection_reasons')
                ->with('client', $client)
                ->with('disconnection_reasons', $disconnection_reasons);
    }

    public function create_disconnection_reason($id)
    {
      $client = Client::find($id);

      return view('admin.client.create_disconnection_reason')
                ->with('client', $client);
    }

    public function store_disconnection_reason(Request $request)
    {
      $disconnection_reason = new DisconnectionReason;
      $disconnection_reason->client_id = $request->client_id;
      $disconnection_reason->cause = $request->cause;
      $disconnection_reason->solution = $request->solution;
      $disconnection_reason->save();

      return redirect('/admin/client/disconnection_reasons/' . $request->client_id);
    }

    public function delete_disconnection_reason($id)
    {
      $disconnection_reason = DisconnectionReason::find($id);
      $disconnection_reason->delete();
    }
}
