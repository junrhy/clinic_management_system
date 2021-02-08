@extends('layouts.admin')

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #cccccc;
    opacity: 1;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Update Billing eStatement <small class="text-muted">Update billing statements</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item"><a href="/admin/billing/view_estatements/{{ $client->id }}"><i class="fa fa-user"></i> {{ $client->name }}</a></li>
                            <li class="breadcrumb-item active">Update Billing eStatement</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Clients</div>

                <div class="panel-body">
                    <div class="row col-md-3">
                          {{ Form::model($billing_statement, array('route' => array('admin.billing.update', $client->id), 'method' => 'PUT')) }}
                            <div class="form-group">
                              {{ Form::label('billed_at', 'Bill Date') }}
                              {{ Form::text('billed_at', $billing_statement->billed_at->format('m/d/Y'), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('due_at', 'Due Date') }}
                              {{ Form::text('due_at', $billing_statement->due_at->format('m/d/Y'), array('class' => 'form-control', 'required', 'placeholder' => 'mm/dd/yyyy')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('amount_due', 'Amount Due') }}
                              {{ Form::number('amount_due', Input::old('amount_due'), array('class' => 'form-control', 'required')) }}
                            </div>

                            <h3 style="color: #018d8e; font-family: 'arial';">Additional</h3>
                            <div class="form-group">
                              {{ Form::label('tax', 'Tax') }}
                              {{ Form::number('tax', Input::old('tax'), array('class' => 'form-control', 'required')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('unpaid', 'Unpaid') }}
                              {{ Form::number('unpaid', Input::old('unpaid'), array('class' => 'form-control', 'required')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('penalties', 'Penalties') }}
                              {{ Form::number('penalties', Input::old('penalties'), array('class' => 'form-control', 'required')) }}
                            </div>

                            <h3 style="color: #018d8e; font-family: 'arial';">Deductions</h3>
                            <div class="form-group">
                              {{ Form::label('interest', 'Interest') }}
                              {{ Form::number('interest', Input::old('interest'), array('class' => 'form-control', 'required')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('discount', 'Discount') }}
                              {{ Form::number('discount', Input::old('discount'), array('class' => 'form-control', 'required')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('advance_payment', 'Advance Payment') }}
                              {{ Form::number('advance_payment', Input::old('advance_payment'), array('class' => 'form-control', 'required')) }}
                            </div>

                            <h3 style="color: #018d8e; font-family: 'arial';">Last Payment</h3>
                            <div class="form-group">
                              {{ Form::label('last_payment_date', 'Last Payment Date') }}
                              {{ Form::text('last_payment_date', Input::old('last_payment_date'), array('class' => 'form-control', 'readonly')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('last_payment_transaction_no', 'Last Payment Transaction Number') }}
                              {{ Form::text('last_payment_transaction_no', Input::old('last_payment_transaction_no'), array('class' => 'form-control', 'readonly')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('last_payment_amount', 'Last Payment Amount') }}
                              {{ Form::text('last_payment_amount', Input::old('last_payment_amount'), array('class' => 'form-control', 'readonly')) }}
                            </div>

                            <h3 style="color: #018d8e; font-family: 'arial';">Total</h3>
                            <div class="form-group">
                              {{ Form::label('outstanding_balance', 'Outstanding balance') }} <small>(auto-calculated)</small>
                              {{ Form::text('outstanding_balance', Input::old('outstanding_balance'), array('class' => 'form-control', 'readonly')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('payment_reference_no', 'Payment Reference No.') }} <small>(auto-generated)</small>
                              {{ Form::text('payment_reference_no', Input::old('payment_reference_no'), array('class' => 'form-control', 'readonly')) }}
                            </div>

                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                            
                            {{ Form::submit('Save Changes', array('class' => 'btn btn-primary btn-round')) }}
                          {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#billed_at").datepicker({  
    minDate: '0',
    format: 'mm/dd/yyyy',
    changeMonth: true,
    changeYear: false,
    // isRTL: true
  });

  $("#due_at").datepicker({  
    minDate: '0',
    format: 'mm/dd/yyyy',
    changeMonth: true,
    changeYear: false,
    // isRTL: true
  });

  function calculate_balance() {
    amount_due = parseFloat($("#amount_due").val());

    tax = parseFloat($("#tax").val());
    unpaid = parseFloat($("#unpaid").val());
    penalties = parseFloat($("#penalties").val());

    interest = parseFloat($("#interest").val());
    discount = parseFloat($("#discount").val());
    advance_payment = parseFloat($("#advance_payment").val());

    additional = tax + unpaid + penalties;
    deductions = interest + discount + advance_payment;

    outstanding_balance = parseFloat( (amount_due + additional) - deductions );

    $("#outstanding_balance").val(outstanding_balance);
  }

  $("#amount_due, #tax, #unpaid, #penalties, #interest, #discount, #advance_payment").on("keyup change", function(e) {
    calculate_balance();
  });
});
</script>
@endsection
