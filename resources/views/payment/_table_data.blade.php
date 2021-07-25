<table class="table table-striped">
<thead>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Gender</th>
  <th>Date of Birth</th>
  <th>Age</th>
  <th>Contact</th>
  <th>Total Invoice</th>
  <th>Total Payment</th>
  <th>Total Balance</th>
  <th style="text-align:right;">Action</th>
</thead>
@if($patients->count() > 0)
<?php foreach ($patients as $patient_key => $patient_item): ?>
<tr>
  <td>{{ $patient_item->first_name }}</td>
  <td>{{ $patient_item->last_name }}</td>
  <td>{{ $patient_item->gender }}</td>
  <td><span style="font-family: sans-serif;">{{ $patient_item->dob->format('M d, Y') }}</span></td>
  <td><span style="font-family: sans-serif;">{{ $patient_item->dob->age }}</span></td>
  <td><span style="font-family: sans-serif;">{{ $patient_item->contact_number }}</span></td>
  <td><span style="font-family: sans-serif;">{{ number_format($patient_item->charges->sum('amount'), 2) }}</span></td>
  <td><span style="font-family: sans-serif;">{{ number_format($patient_item->payments->sum('amount'), 2) }}</span></td>
  <td><span style="font-family: sans-serif;">{{ number_format($patient_item->charges->sum('amount') - $patient_item->payments->sum('amount'), 2) }}</span></td>
  <td align="right">
      <a class="show-payment {{ App\Model\FeatureUser::is_feature_allowed('view_patient_payment', Auth::user()->id) }}" href="{{ route('payment.show',$patient_item->id) }}"><i class="fa fa-file-alt" aria-hidden="true"></i> View Payments</a>
       |
      <a class="show-balance {{ App\Model\FeatureUser::is_feature_allowed('view_patient_balance', Auth::user()->id) }}" 
        href="{{ url("/billing/patient_balance_report/{$patient_item->id}") }}"><i class="fa fa-file-alt" aria-hidden="true"></i> View Balance</a>
 </td>
</tr>
<?php endforeach; ?>
@else
<tr>
  <td colspan="8" class="text-center">No record found</td>
</tr>
@endif
</table>