<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Model\Domain;

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
            if ($landing == 'default') {
                $view = 'landing.default';
            } else {
                $view = 'landing.subdomain_default';
            }
      	}

    	return view($view);
    }

    public function send_contact_us_message(Request $request)
    {
        $send_to_name = env('MAIL_CONTACT_US_RECIPIENT_NAME');
        $send_to_email = env('MAIL_CONTACT_US_RECIPIENT_EMAIL');

        Mail::send(new ContactUsMessage($request));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
