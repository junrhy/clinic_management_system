<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Client;
use App\Model\Subscription;

use Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subscriptions = Subscription::where('client_id', Auth::user()->client_id)
                                    ->where('is_active', true)
                                    ->get();

    	return view('subscription.index')
                    ->with('subscriptions', $subscriptions);
    }

    public function view_estatements()
    {
    	return view('subscription.view_estatements');
    }

    public function balance_and_usage()
    {
    	return view('subscription.balance_and_usage');
    }

    public function pay_bills()
    {
    	return view('subscription.pay_bills');
    }

    public function subscribe(Request $request)
    {
        // deactivate this client subscriptions
        $subscriptions = Subscription::where('client_id', Auth::user()->client_id)->update(array('is_active' => 0));

        // creat new subscription
        if ($request->frequency == 'yearly') {
            $subscription_ends = Carbon::now()->addDays(365);
        } else {
            $subscription_ends = Carbon::now()->addDays(30);
        }

        $subscription = new Subscription;
        $subscription->client_id = Auth::user()->client_id;
        $subscription->plan = $request->plan;
        $subscription->currency = 'php';
        $subscription->amount = $request->amount;
        $subscription->frequency = $request->frequency;
        $subscription->start = Carbon::now();
        $subscription->end = $subscription_ends;
        $subscription->bill_day = $subscription_ends->subDays(10)->format('d');
        $subscription->is_active = true;
        $subscription->save();

        $client = Client::find(Auth::user()->client_id);
        $client->account_type = $subscription->plan;
        $client->save();
    }
}
