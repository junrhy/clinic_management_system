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
      $client->account_type = $request->account_type;
      $client->app_license_no = $request->app_license_no;
      $client->slug = $request->slug;
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

    public function inactive_clients()
    {
      $clients = Client::all();

      return view('admin.client.inactive_clients')
            ->with('clients', $clients);
    }

    public function delete_client(Request $request)
    {
      $client = Client::find($request->id);

      \App\Model\Patient::where('client_id', $client->id)->delete();
      \App\Model\Service::where('client_id', $client->id)->delete();
      \App\Model\Clinic::where('client_id', $client->id)->delete();
      \App\Model\Doctor::where('client_id', $client->id)->delete();
      \App\Model\Domain::where('client_id', $client->id)->delete();
      \App\Model\BillingStatement::where('client_id', $client->id)->delete();
      \App\Model\ClientCard::where('client_id', $client->id)->delete();
      \App\Model\DentalChart::where('client_id', $client->id)->delete();
      \App\Model\DentalNote::where('client_id', $client->id)->delete();
      \App\Model\DisconnectionReason::where('client_id', $client->id)->delete();
      \App\Model\Inventory::where('client_id', $client->id)->delete();
      \App\Model\PatientBillingCharge::where('client_id', $client->id)->delete();
      \App\Model\PatientBillingPayment::where('client_id', $client->id)->delete();
      \App\Model\PatientDetail::where('client_id', $client->id)->delete();
      \App\Model\Prescription::where('client_id', $client->id)->delete();
      \App\Model\Subscription::where('client_id', $client->id)->delete();


      foreach (\App\User::where('client_id', $client->id)->get() as $key => $user) {
          
          $features = \App\Model\FeatureUser::all();

          foreach ($features as $key => $feature) {
              $user_ids = array_map('intval', explode(',', $feature->user_ids));

              if (($key = array_search($user->id, $user_ids)) !== false) {
                  unset($user_ids[$key]);
              }

              sort($user_ids);
              
              $feature->user_ids = implode(',', $user_ids);
              $feature->save();
          }
      }

      \App\User::where('client_id', $client->id)->forceDelete();

      $client->delete();
    }
}
