<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Subscription;

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
}
