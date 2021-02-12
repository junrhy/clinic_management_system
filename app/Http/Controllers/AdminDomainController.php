<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Client;
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

    public function create()
    {
        $clients = Client::all();

        return view('admin.domain.create')
                    ->with('clients', $clients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'domain_name' => 'unique:domains',
        ]);

        $domain = new Domain;
        $domain->client_id = $request->client_id;
        $domain->domain_name = $request->domain_name;
        $domain->params = $request->params;
        $domain->distributor_code = $request->distributor_code;
        $domain->save();

        return redirect('admin/domains');
    }

    public function delete($id)
    {
        $domain = Domain::find($id);
        $domain->delete();
    }
}
