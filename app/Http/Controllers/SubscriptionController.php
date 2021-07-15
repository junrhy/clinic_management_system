<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Client;
use App\Model\Subscription;
use App\Model\BillingStatement;
use App\Model\ClientCard;

use Auth;
use Carbon\Carbon;
use PDF;

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
        $billing_statements = BillingStatement::where('is_publish', true)->orderBy('billed_at', 'DESC')->get();

    	return view('subscription.view_estatements')
                    ->with('billing_statements', $billing_statements);
    }

    public function balance_and_usage()
    {
        $billing_statement = BillingStatement::where('is_latest', true)
                                    ->where('is_publish', true)
                                    ->first();

        if ($billing_statement != null) {
            $bill_period = $billing_statement->billed_at->format('F Y');
            $prev_bill_balance = $billing_statement->amount_past_due;
            $current_bill_charges = $billing_statement->amount_due;
            $adjustments = ($billing_statement->penalties) + -$billing_statement->advance_payment + -$billing_statement->discount;
            $total_amount_due = $prev_bill_balance + $current_bill_charges + $adjustments;
            $payment_due_date = $billing_statement->due_at->format('M d, Y');
        } else {
            $bill_period = 'N/A';
            $prev_bill_balance = 0;
            $current_bill_charges = 0;
            $adjustments = 0;
            $total_amount_due = 0;
            $payment_due_date = 'N/A';
        }

    	return view('subscription.balance_and_usage')
                    ->with('bill_period', $bill_period)
                    ->with('prev_bill_balance', $prev_bill_balance)
                    ->with('current_bill_charges', $current_bill_charges)
                    ->with('adjustments', $adjustments)
                    ->with('total_amount_due', $total_amount_due)
                    ->with('payment_due_date', $payment_due_date);
    }

    public function pay_bills()
    {
        $billing_statement = BillingStatement::where('is_latest', true)
                                    ->where('is_publish', true)
                                    ->first();

    	return view('subscription.pay_bills')
                    ->with('billing_statement', $billing_statement);
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

    public function view_billing_statement($id)
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

    public function payment_method()
    {
        $client_cards = ClientCard::where('client_id', Auth::user()->client_id)->get();

        return view('subscription.payment_method')
                    ->with('client_cards', $client_cards);
    }

    public function save_card(Request $request)
    {
        $default_card = ClientCard::where('client_id', Auth::user()->client_id)
                                    ->where('is_default', 1)
                                    ->first();

        $client_card = new ClientCard;
        $client_card->client_id = Auth::user()->client_id;
        $client_card->name_on_card = $request->cname;
        $client_card->card_number = $request->ccnum;
        $client_card->expiry_month = $request->expmonth;
        $client_card->expiry_year = $request->expyear;

        if ($default_card == null) {
            $client_card->is_default = true;
        }

        $client_card->save();
    }

    public function remove_card(Request $request)
    {
        $client_card = ClientCard::find($request->id);
        $client_card->delete();
    }

    public function make_primary(Request $request)
    {
        ClientCard::where('client_id', Auth::user()->client_id)
                    ->update(['is_default' => false]);

        $client_card = ClientCard::find($request->id);
        $client_card->is_default = true;
        $client_card->save();
    }
}
