<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Subscription;

use Carbon\Carbon;

class AdminSubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$subscriptions = Subscription::where('is_active', true)->get();

    	return view('admin.subscription.index')
    				->with('subscriptions', $subscriptions);
    }

    public function renew($id)
    {
        $subscription = Subscription::find($id);

        // update subscription
        if ($subscription->frequency == 'yearly') {
            $subscription_ends = Carbon::now()->addDays(365);
        } else {
            $subscription_ends = Carbon::now()->addDays(30);
        } 

        $subscription->start = Carbon::now();
        $subscription->end = $subscription_ends;
        $subscription->save();

        return redirect('/admin/subscriptions');
    }

}
