<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use App\Model\Client;

use Storage;

class WebhookController extends Controller
{
	public function __construct()
    {
         /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );

        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function paypal_subscription_activated(Request $request)
    {
    	if ($request->has('custom') && strpos($request->custom, 'clientid_') !== false) {

    		$client_id = str_replace('clientid_', '', $request->custom);

	    	if (Client::where('id', '=', $client_id)->count() > 0) {
                $client = Client::find($client_id);
                
                if ($request->txn_type == 'subscr_signup') {

                    $client->account_type = 'business';
                    $client->paypal_subscr_id = $request->subscr_id;
                    $client->payer_first_name = $request->first_name;
                    $client->payer_last_name = $request->last_name;
                    $client->payer_email = $request->payer_email;
                    $client->payment_receiver_email = $request->receiver_email;
                    $client->paypal_subscr_date = $request->subscr_date;

                } elseif ($request->txn_type == 'subscr_cancel') {

                    $client->is_active = false;

                } elseif ($request->txn_type == 'subscr_payment') {

                    $client->payment_fee = $request->payment_fee;
                    $client->paypal_payment_date = $request->payment_date;

                } elseif ($request->txn_type == 'recurring_payment_suspended' || $request->txn_type == 'recurring_payment_suspended_due_to_max_failed_payment') {

                    $client->is_suspended = true;

                }
                
                $client->save();
	    	}
    	}

    	Storage::put( 'myfile.txt', $request->getContent());

        echo "Listener Complete!";
    }
}
