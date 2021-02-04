<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\ClientBillingPayment;

class AdminPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$payments = ClientBillingPayment::Raw('client_id, SUM(amount) as total_payments')->get();

    	return view('admin.payment.index')
    				->with('payments', $payments);
    }
}
