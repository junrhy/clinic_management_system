<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Client;
use App\Model\ClientBillingPayment;

use Carbon\Carbon;

class AdminPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$clients = Client::all();

    	return view('admin.payment.index')
    				->with('clients', $clients);
    }

    public function view_payments($client_id)
    {
        $client = Client::find($client_id);

        $payments = ClientBillingPayment::where('client_id', $client_id)->orderBy('created_at', 'ASC')->get();

        return view('admin.payment.view_payments')
                    ->with('client', $client)
                    ->with('payments', $payments);
    }

    public function create_payment($client_id)
    {
        $client = Client::find($client_id);

        $date_now = Carbon::now()->format('m/d/Y');

        return view('admin.payment.create_payment')
                    ->with('client', $client)
                    ->with('date_now', $date_now);
    }

    public function store_payment(Request $request)
    {
        $payment_transaction_no = $request->client_id.rand(100000000000, 999999999999);

        $payment = new ClientBillingPayment;
        $payment->paid_at = Carbon::createFromFormat('m/d/Y', $request->paid_at);
        $payment->client_id = $request->client_id;
        $payment->amount = $request->amount;
        $payment->payment_reference_no = $request->payment_reference_no;
        $payment->payment_transaction_no = $payment_transaction_no;
        $payment->mode_of_payment = $request->mode_of_payment;
        $payment->save();

        return redirect('/admin/payments/view_payments/'.$request->client_id);
    }

    public function delete_payment($id)
    {
        $payment = ClientBillingPayment::find($id);
        $payment->delete();
    }
}
