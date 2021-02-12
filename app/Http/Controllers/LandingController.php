<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Domain;

use View;

class LandingController extends Controller
{
    public function index(Request $request)
    {
    	$domain_name = $request->gethost();

        $domain = Domain::where('domain_name', $domain_name)->first();

    	if ($domain) {
    		$landing = str_replace('.', '_', $domain->domain_name);
    	} else {
    		$landing = 'default';
    	}

    	if(View::exists('landing.'.$landing)){
		    $view = 'landing.'.$landing;
    	} else {
    		$view = 'landing.default';
    	}

    	return view($view);
    }
}
