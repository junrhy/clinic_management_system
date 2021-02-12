<head>
	<title>{{ $billing_statement->billed_at->format('F d, Y') }} Billing Statement</title>
</head>
<style type="text/css">
	body {
		font-family: sans-serif;
	}

	th {
		background-color: #01d8da;
	}	

	#account_info {
		font-size: 14pt;
	}

	.center {
		margin-left: auto;
		margin-right: auto;
	}

	.page-break {
	    page-break-after: always;
	}
</style>

<table  width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>Account Name: {{ $client->name }}</td>
		<td width="25%">Bill Date: {{ $billing_statement->billed_at->format('m/d/Y') }}</td>
	</tr>
	<tr>
		<td>Account No.: {{ $client->account_number }}</td>
		<td>Due Date: {{ $billing_statement->due_at->format('m/d/Y') }}</td>
	</tr>
	<tr>
		<td colspan="2">Address:</td>
	</tr>
</table>
<h3 align="center">Account Information</h3>
<div id="account_info">
	<div align="center"><small>Note: You may cut this portion, or simply take a photo of it and present it to any of our Collecting Partners every time you pay your subscription.</small></div>
	<br>
	<table class="center" width="60%" cellpadding="5" cellspacing="0" border="1">
		<tr>
			<td align="left" style="background-color: #01d8da;" width="55%">Account Number: </td>
			<td>{{ $client->account_number }}</td>
		</tr>
		<tr>
			<td align="left" style="background-color: #01d8da;">Due Date: </td>
			<td>{{ $billing_statement->due_at->format('m/d/Y') }}</td>
		</tr>
		<tr>
			<td align="left" style="background-color: #01d8da;">Total Amount Due: </td>
			<td>{{ number_format($total_amount_due, 2) }}</td>
		</tr>

		<tr>
			<td align="left" style="background-color: #01d8da;">Payment Reference No.: </td>
			<td>{{ $billing_statement->payment_reference_no }}</td>
		</tr>
	</table>
</div>
<br>
<h3 align="center">Statement Summary</h3>
<h4 align="center">As of {{ $billing_statement->billed_at->format('F d, Y') }}</h4>

<table class="table table-striped" width="100%" cellpadding="5" cellspacing="0" border="1">
	<thead>
		<tr>
			<th align="center">Amount Past Due</th>
			<th align="center">Penalties</th>
			<th align="center">Discount</th>
			<th align="center">Current Amount Due</th>
			<th>Total Amount Due</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center">{{ $app_currency }} {{ number_format($billing_statement->amount_past_due, 2) }}</td>
			<td align="center">{{ $app_currency }} {{ number_format($billing_statement->penalties, 2) }}</td>
			<td align="center">{{ $app_currency }} {{ number_format($billing_statement->discount, 2) }}</td>
			<td align="center">{{ $app_currency }} {{ number_format($billing_statement->amount_due, 2) }}</td>
			<td align="center">
				<?php 
                  $prev_bill_balance = $billing_statement->amount_past_due;
	              $current_bill_charges = $billing_statement->amount_due;
	              $adjustments = ($billing_statement->penalties) - ($billing_statement->advance_payment - $billing_statement->discount);
	              $total_amount_due = $prev_bill_balance + $current_bill_charges + $adjustments;
	            ?>
	            {{ $client->currency }} {{ number_format($total_amount_due, 2) }}
			</td>
		</tr>
	</tbody>
</table>
<br>
<h3 align="center">Last Payment Details</h3>

<table class="table table-striped" width="100%" cellpadding="5" cellspacing="0" border="1">
	<thead>
		<tr>
			<th align="center">Payment Date</th>
			<th align="center">Transaction No.</th>
			<th align="center">Amount</th>
			<th align="center">Advance Payment**</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php $last_payment = $client->payments->first(); ?>

			<td align="center">{{ $last_payment->created_at->format('M d, Y')  }}</td>
			<td align="center">{{ $last_payment->payment_transaction_no  }}</td>
			<td align="center">{{ $app_currency }} {{ number_format($last_payment->amount, 2)  }}</td>
			<td align="center">{{ $app_currency }} {{ number_format($billing_statement->advance_payment, 2)  }}</td>
		</tr>
	</tbody>
</table>
<br>
<h3 align="center">Payment Reminders</h3>
<ol type="1">
	<li>Please present this Billing Statement when paying at any Accredited Collecting Partners. However, for payments made beyond the due date, corresponding penalties shall be charged to your account.</li>
	<li>Payments made after the previous bill period's due date may not be reflected in this bill.</li>
	<li>Please notify us immediately of any changes in your billing address or personal data.</li>
	<li>This bill is considered accurate if no advice is received within 10 days from receipt.</li>
</ol>
<br>
<table width="100%" cellpadding="2" cellspacing="0" border="0">
	<tr>
		<td width="70%" colspan="2"><strong>Connect with Us</strong></td>
		<td>&nbsp;</td>
		<td width="30%" colspan="2"><strong>Contact Us</strong></td>
	</tr>
	<tr>
		<td width="10%">Website: </td>
		<td>{{ $bill_website_url }}</td>
		<td width="5%">&nbsp;</td>
		<td width="14%">Tel. Nos.:</td>
		<td>{{ $bill_contact_numbers }}</td>
	</tr>
	<tr>
		<td>Facebook: </td>
		<td>{{ $bill_facebook_page }}</td>
		<td>&nbsp;</td>
		<td>Email:</td>
		<td>{{ $bill_contact_email }}</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>Look for:</td>
		<td>{{ $bill_contact_persons }}</td>
	</tr>
</table>

<div class="page-break"></div>

<h3 align="center">Payment Transaction History</h3>

<table class="table table-striped" width="100%" cellpadding="5" cellspacing="0" border="1">
	<thead>
		<tr>
			<th align="center">Payment Date</th>
			<th align="center">Transaction No.</th>
			<th align="center">Bill Reference No.</th>
			<th align="right">Amount</th>
		</tr>
	</thead>
	<tbody>
		@foreach($client->payments->take(10) as $payment)
		<tr>
			<td align="center">{{ $payment->created_at->format('M d, Y')  }}</td>
			<td align="center">{{ $payment->payment_transaction_no  }}</td>
			<td align="center">{{ $payment->payment_reference_no  }}</td>
			<td align="right">{{ $app_currency }} {{ number_format($payment->amount, 2)  }}</td>
		</tr>
		@endforeach
	</tbody>
</table>