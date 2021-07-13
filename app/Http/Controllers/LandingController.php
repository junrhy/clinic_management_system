<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Model\Domain;
use App\Model\Client;

use App\Mail\ContactUsMessage;

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

    public function client_page(Request $request)
    {
        $client = Client::where('slug', $request->client_slug)->first();

        if ($client == null) {
            return abort(404, 'Client profile does not exist.');
        }

        return view('landing.client.default')
                    ->with('client', $client);
    }

    public function send_contact_us_message(Request $request)
    {
        $send_to_name = env('MAIL_CONTACT_US_RECIPIENT_NAME');
        $send_to_email = env('MAIL_CONTACT_US_RECIPIENT_EMAIL');

        Mail::send(new ContactUsMessage($request));

        return redirect()->back()->with('success', 'Your message has been sent! A representative will contact you shortly.');
    }
}
