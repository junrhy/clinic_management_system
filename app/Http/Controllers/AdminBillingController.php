<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Client;
use App\Model\Subscription;
use App\Model\BillingStatement;
use App\Model\ClientBillingPayment;

use Carbon\Carbon;
use PDF;

class AdminBillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$clients = Client::all();

        return view('admin.billing.index')
    				->with('clients', $clients);
    }

    public function view_estatements($id)
    {
        $client = Client::find($id);

        $billing_statements = BillingStatement::where('client_id', $client->id)->orderBy('billed_at', 'DESC')->get();

        return view('admin.billing.view_estatements')
                    ->with('client', $client)
                    ->with('billing_statements', $billing_statements);
    }

    public function create_estatement($id)
    {
        $client = Client::find($id);

        $billing_statement_max_id = BillingStatement::whereRaw('id = (select max(`id`) from billing_statements)')->first();

        if ($billing_statement_max_id) {
            $unique_id = $billing_statement_max_id->id + 1;
        } else {
            $unique_id = 1;
        }
        
        $payment_reference_number = $unique_id . rand(100000, 999999);

        $last_payment = ClientBillingPayment::orderBy('created_at', 'DESC')->first();

        $bill_date = Carbon::now()->format('m/d/Y');
        $due_date = Carbon::now()->addDays(5)->format('m/d/Y');

        return view('admin.billing.create_estatement')
                    ->with('client', $client)
                    ->with('payment_reference_number', $payment_reference_number)
                    ->with('last_payment', $last_payment)
                    ->with('bill_date', $bill_date)
                    ->with('due_date', $due_date);
    }

    public function store_estatement(Request $request)
    {
        $billing_statement = new BillingStatement;
        $billing_statement->client_id = $request->client_id;
        $billing_statement->billed_at = Carbon::createFromFormat('m/d/Y', $request->billed_at);
        $billing_statement->due_at = Carbon::createFromFormat('m/d/Y', $request->due_at);
        $billing_statement->amount_past_due = $request->amount_past_due;
        $billing_statement->amount_due = $request->amount_due;
        $billing_statement->discount = $request->discount;
        $billing_statement->penalties = $request->penalties;
        $billing_statement->advance_payment = $request->advance_payment;
        $billing_statement->payment_reference_no = $request->payment_reference_no;
        $billing_statement->save();

        return redirect('/admin/billing/view_estatements/'.$request->client_id);
    }

    public function edit_estatement($id)
    {
        $billing_statement = BillingStatement::find($id);

        $client = Client::find($billing_statement->client_id);

        return view('admin.billing.edit_estatement')
                    ->with('client', $client)
                    ->with('billing_statement', $billing_statement);
    }

    public function update_estatement(Request $request, $id)
    {
        $billing_statement = BillingStatement::find($id);

        $billing_statement->billed_at = Carbon::createFromFormat('m/d/Y', $request->billed_at);
        $billing_statement->due_at = Carbon::createFromFormat('m/d/Y', $request->due_at);
        $billing_statement->amount_past_due = $request->amount_past_due;
        $billing_statement->amount_due = $request->amount_due;
        $billing_statement->discount = $request->discount;
        $billing_statement->penalties = $request->penalties;
        $billing_statement->advance_payment = $request->advance_payment;
        $billing_statement->save();

        return redirect('/admin/billing/view_estatements/'.$billing_statement->client_id);
    }

    public function pdf_estatement($id)
    {
        $billing_statement = BillingStatement::find($id);
        
        $client = Client::find($billing_statement->client_id);

        $prev_bill_balance = $billing_statement->amount_past_due;
        $current_bill_charges = $billing_statement->amount_due;
        $adjustments = ($billing_statement->penalties) - ($billing_statement->advance_payment - $billing_statement->discount);

        $total_amount_due = $prev_bill_balance + $current_bill_charges + $adjustments;

        $data = ['client' => $client, 'billing_statement' => $billing_statement, 'total_amount_due' => $total_amount_due];

        $pdf = PDF::loadView('admin.billing.pdf_estatement', $data);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function delete_estatement($id)
    {
        $billing_statement = BillingStatement::find($id);
        
        $client_id = $billing_statement->client_id;

        $billing_statement->delete();

        $prev_statement = BillingStatement::where('client_id', $client_id)->orderBy('billed_at', 'DESC')->first();

        if ($prev_statement != null) {
            $previous_statement = BillingStatement::find($prev_statement->id);
            $previous_statement->is_latest = true;
            $previous_statement->save();
        }
        
        
    }

    public function publish_estatement($id)
    {
        $billing_statement = BillingStatement::find($id);

        BillingStatement::where('client_id', $billing_statement->client_id)->update(['is_latest' => false]);
                
        $billing_statement->is_latest = true;
        $billing_statement->is_publish = true;
        $billing_statement->save();
    }
}
