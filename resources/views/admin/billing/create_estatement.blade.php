@extends('layouts.admin')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

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
                        <h2>Add Billing eStatement <small class="text-muted">Admin Portal</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Portal</a></li>
                            <li class="breadcrumb-item"><a href="/admin/billing/view_estatements/{{ $client->id }}"><i class="fa fa-user"></i> {{ $client->name }}</a></li>
                            <li class="breadcrumb-item active">Add Billing eStatement</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ $client->name }}</div>

                <div class="panel-body">
                  <div class="row col-md-3">
                      {{ Html::ul($errors->all()) }}

                      {{ Form::open(array('url' => '/admin/billing/store', 'id' => 'form-add-billing-estatement')) }}
                        <div class="form-group">
                          {{ Form::label('billed_at', 'Bill Date') }}
                          {{ Form::text('billed_at', $bill_date, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('due_at', 'Due Date') }}
                          {{ Form::text('due_at', $due_date, array('class' => 'form-control', 'required', 'placeholder' => 'mm/dd/yyyy')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('amount_due', 'Amount Due') }}
                          {{ Form::number('amount_due', 0, array('class' => 'form-control', 'required',  'step' => '.01')) }}
                        </div>

                        <h3 style="color: #018d8e; font-family: 'arial';">Additional</h3>
                        <div class="form-group">
                          {{ Form::label('amount_past_due', 'Amount Past Due') }}
                          {{ Form::number('amount_past_due', 0, array('class' => 'form-control', 'required',  'step' => '.01')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('penalties', 'Penalties') }}
                          {{ Form::number('penalties', 0, array('class' => 'form-control', 'required',  'step' => '.01')) }}
                        </div>

                        <h3 style="color: #018d8e; font-family: 'arial';">Deductions</h3>

                        <div class="form-group">
                          {{ Form::label('discount', 'Discount') }}
                          {{ Form::number('discount', 0, array('class' => 'form-control', 'required',  'step' => '.01')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('advance_payment', 'Advance Payment') }}
                          {{ Form::number('advance_payment', 0, array('class' => 'form-control', 'required',  'step' => '.01')) }}
                        </div>

                        <input type="hidden" name="last_payment_date" value="{{ $last_payment != null ? $last_payment->created_at->format('m-d-Y') : null }}">
                        <input type="hidden" name="last_payment_transaction_no" value="{{ $last_payment != null ? $last_payment->payment_transaction_no : null }}">
                        <input type="hidden" name="last_payment_amount" value="{{ $last_payment != null ? $last_payment->amount : null }}">
                        <input type="hidden" name="payment_reference_no" value="{{ $payment_reference_number }}">
                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                        {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-round')) }}
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

  $("#billed_at").on("keyup change", function(e) {
    $("#due_at").val($("#billed_at").val());
  });

  $("#due_at").on("keyup change", function(e) {
    if (new Date($("#due_at").val()) < new Date($("#billed_at").val())) {
      
      Swal.fire({
        title: 'Not Allowed!',
        text: "Due date must be later or equal the Bill date.",
        type: 'error'
      });

      $("#due_at").val($("#billed_at").val());
    }
  });
});
</script>
@endsection
