@extends('layouts.admin')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">

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

                      {{ Form::open(array('url' => '/admin/payment/store', 'id' => 'form-add-payment')) }}
                        <div class="form-group">
                          {{ Form::label('paid_at', 'Payment Date') }}
                          {{ Form::text('paid_at', $date_now, array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('amount', 'Amount') }}
                          {{ Form::number('amount', null, array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('payment_reference_no', 'Payment Reference Number') }} <small>(from billing statement)</small>
                          {{ Form::text('payment_reference_no', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('mode_of_payment', 'Mode Of Payment') }}
                          <select name="mode_of_payment" class="form-control">
                               <option value="cash">Cash</option>
                          </select>
                        </div>

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
  $("#paid_at").datepicker({  
      format: 'mm/dd/yyyy',
      changeMonth: true,
      changeYear: true,
  });
});
</script>
@endsection
