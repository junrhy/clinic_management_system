<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Model\Domain;
use App\Model\Client;
use App\Model\MessageRoom;
use App\Model\Message;
use App\User;

use App\Mail\ContactUsMessage;

use View;

class LandingController extends Controller
{
    public function index(Request $request)
    {
    	$domain_name = $request->gethost();

        $domain = Domain::where('domain_name', $domain_name)->first();

        $client_homepage = '';
        
    	if ($domain) {
    		$client_homepage = str_replace('.', '_', $domain->domain_name);
    	}

    	if(View::exists('landing.client.'.$client_homepage)){
		    $view = 'landing.client.'.$client_homepage;
    	} else {
            $view = 'landing.default';
       	}

    	return view($view);
    }

    public function client_page(Request $request)
    {
        $client = Client::where('slug', $request->client_slug)->first();

        if ($client == null) {
            return abort(404, 'Profile does not exist.');
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

    public function book_appointment(Request $request)
    {
        $member_ids = [];

        $client_users = User::select('id')
                        ->where('client_id', $request->client_id)
                        ->where('type', 'default')
                        ->get();

        foreach ($client_users as $user) {
            array_push($member_ids, $user->id);
        }

        $room = new MessageRoom;
        $room->client_id = $request->client_id;
        $room->name = $request->subject;
        $room->member_user_ids = implode(",", $member_ids);
        $room->read_by_user_ids = 0;
        $room->is_for_admin = 0;
        $room->is_no_reply = 1;
        $room->save();

        $message = new Message;
        $message->client_id = $request->client_id;
        $message->room_id = $room->id;
        $message->user_id = 0;
        $message->message = "First Name: ".$request->first_name."<br/>"."Last Name: ".$request->last_name."<br/>"."Mobile #: ".$request->mobile_number."<br/>"."Email: ".$request->email."<br/>"."Subject: ".$request->subject."<br/><br/>"."Message: <br/><br/>".$request->message_body;
        $message->save();
    }
}
