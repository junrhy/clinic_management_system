@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<style type="text/css">
  .delete-link {
    color: gray;
    font-size:12pt;
  }

  .delete-link:hover {
    color: red;
    font-size:12pt;
  }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                  <i class="fa fa-notes-medical"></i> Patient
                  <div class="row" style="font-size:12pt;">
                    <h4 style="padding:10px;background-color:#45a29e;color:#fff;"><i class="fa fa-address-card"></i> Basic Information</h4>

                    <table class="col-md-offset-1">
                      <tr>
                        <td class="col-md-2 text-right">First Name:</td>
                        <td>{{ $patient->first_name }}</td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Last Name:</td>
                        <td>{{ $patient->last_name }}</td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Gender:</td>
                        <td>{{ $patient->gender }}</td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Email:</td>
                        <td>{{ $patient->email }}</td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Contact No.:</td>
                        <td>{{ $patient->contact_number }}</td>
                      </tr>
                    </table>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="row" style="margin-top:30px;">
                      <h4 class="row" style="padding:10px;background-color:#45a29e;color:#fff;"><i class="fa fa-user-md" aria-hidden="true"></i> Medical Records</h4>
                        <table class="table table-striped">
                          <thead>
                            <th style="width:15%">Created</th>
                            <th style="width:60%">Description</th>
                            <th style="width:15%">Schedule</th>
                            <th style="width:1%;text-align:center;">Action</th>
                          </thead>

                          <tbody>
                          @if(count($details) > 0)
                            @foreach ($details as $detail)
                              <tr>
                                  <td>{{ $detail->created_at->format('M d, Y') }}</td>
                                  <td><?php echo $detail->detail ?></td>
                                  <td>
                                    @if($detail->date_scheduled != '')
                                      {{ date('M d, Y', strtotime($detail->date_scheduled)) }}
                                    @else
                                      n/a
                                    @endif
                                  </td>
                                  <td class="text-center"><a class="delete-link delete-detail" data-id="{{ $detail->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                              </tr>
                            @endforeach
                          @else
                            <tr>
                              <td class="text-center" colspan="4">We don't have a record yet for {{ $patient->first_name }} {{ $patient->last_name }}. Use the form below to add new record.</td>
                            </tr>
                          @endif
                          </tbody>
                        </table>
                      
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    {{ Form::label('detail', 'Description') }}
                    {{ Form::textarea('detail', null, ['id' => 'patient_detail','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'maxlength' => 300, 'placeholder' => 'Limit to 300 characters only', 'style' => 'resize:none']) }}
                  </div>
                  
                  <div class="form-group col-md-offset-8 col-md-4">
                    {{ Form::checkbox('checkbox_visit', 'Yes') }}
                    {{ Form::label('checkbox_visit', 'Schedule') }}
                    {{ Form::text('schedule', null, array('id' => 'date_scheduled', 'class' => 'form-control', 'placeholder' => 'mm/dd/yyyy', 'disabled')) }}
                  </div>
     
                  <div class="col-md-offset-9 col-md-3">
                    <a class="btn btn-primary form-control" id="record_detail"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="row" style="margin-top:60px;">
                      <h4 class="row" style="border-bottom:1px solid #eee;padding:10px;background-color:#45a29e;color:#fff;"><i class="fa fa-money" aria-hidden="true"></i> Billing Information</h4>

                      <h5 class="row col-md-12" style="margin-top: 30px;color:#45a29e;"><strong>Charges</strong></h5>

                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th style="width:15%">Date</th>
                            <th style="width: 50%">Description</th>
                            <th style="width:10%" class="text-right">Amount</th>
                            <th style="width:10%" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($billing_charges as $billing_charge)
                          <tr>
                            <td>{{ $billing_charge->created_at->format('M d, Y') }}</td>
                            <td>{{ $billing_charge->description }}</td>
                            <td class="text-right">{{ number_format($billing_charge->amount, 2) }}</td>
                            <td class="text-center"></span><a class="delete-link delete-charge" data-id="{{ $billing_charge->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                          </tr>
                          @endforeach
                          <tr>
                            <td class="text-right" colspan="2">
                              <strong>Total</strong>
                            </td>
                            <td class="text-right">
                              <strong>&#8369; {{ number_format($billing_charges->sum('amount'), 2) }}</strong>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                        <tfoot class="bg-info">
                          <td colspan="4">
                              <div class="row">
                                  <div class="col-md-6 col-md-offset-2">
                                    {{ Form::text('description', null, array('id' => 'charge_description', 'class' => 'form-control', 'maxlength' => 30, 'placeholder' => 'Description')) }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ Form::number('amount', null, array('id' => 'charge_amount', 'class' => 'form-control', 'placeholder' => 'Amount')) }}
                                  </div>

                                  <div class="col-md-2">
                                    <a class="btn btn-primary btn-block" id="add_charge"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                                  </div>               
                              </div>
                          </td>
                        </tfoot>
                      </table>

                      <h5 class="row col-md-12" style="color:#45a29e;"><strong>Payments</strong></h5>
                      
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th style="width:15%">Date</th>
                            <th style="width: 50%">Description</th>
                            <th style="width: 10%" class="text-right">Amount</th>
                            <th style="width:10%" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($billing_payments as $billing_payment)
                          <tr>
                            <td>{{ $billing_payment->created_at->format('M d, Y') }}</td>
                            <td>{{ $billing_payment->description }}</td>
                            <td class="text-right">{{ number_format($billing_payment->amount, 2) }}</td>
                            <td class="text-center"><a class="delete-link delete-payment" data-id="{{ $billing_payment->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                          </tr>
                          @endforeach
                          <tr>
                            <td class="text-right" colspan="2">
                              <strong>Total</strong>
                            </td>
                            <td class="text-right">
                              <strong>&#8369; {{ number_format($billing_payments->sum('amount'), 2) }}</strong>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                        <tfoot class="bg-info">
                          <td colspan="4">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-2">
                                  {{ Form::text('description', null, array('id' => 'payment_description', 'class' => 'form-control', 'maxlength' => 30  , 'placeholder' => 'Description')) }}
                                </div>
                                <div class="col-md-2">
                                  {{ Form::number('amount', null, array('id' => 'payment_amount', 'class' => 'form-control', 'placeholder' => 'Amount')) }}
                                </div>

                                <div class="col-md-2">
                                  <a class="btn btn-primary btn-block" id="add_payment"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                                </div>               
                            </div>
                          </td>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#date_scheduled").datepicker({
    minDate: 0
  });

  $("input[name='checkbox_visit']").click(function(){
      $("#date_scheduled").prop("disabled", !$(this).is(":checked"));
      $("#date_scheduled").val('');
  });

  $("#record_detail").click(function(){
      var patient_detail = $("#patient_detail").val();
      var date_scheduled = $("#date_scheduled").val();

      $.ajax({
        method: "POST",
        url: "/patient/create_detail",
        data: { 
          patient_id: "{{ $patient->id }}",
          detail: patient_detail, 
          date_scheduled: date_scheduled, 
          _token: "{{ csrf_token() }}" 
        }
      })
      .done(function( msg ) {
        location.reload();
      });
  });

  // Limit textarea new lines to 4
  $('#patient_detail').keydown(function(e) {

      newLines = $(this).val().split("\n").length;

      if(e.keyCode == 13 && newLines >= 4) {
          return false;
      }
  });

  $("#add_charge").click(function(){
      var description = $("#charge_description").val();
      var amount = $("#charge_amount").val();

      if (description != '' && amount != '') {
        $.ajax({
          method: "POST",
          url: "/patient/create_billing_charge",
          data: { 
            patient_id: "{{ $patient->id }}",
            description: description, 
            amount: amount, 
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Saved!',
            'New charge successfully added.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });
      } else {
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Fields must not be empty.'
        })
      }
  });

  $("#add_payment").click(function(){
      var description = $("#payment_description").val();
      var amount = $("#payment_amount").val();

      if (description != '' && amount != '') {
        $.ajax({
          method: "POST",
          url: "/patient/create_billing_payment",
          data: { 
            patient_id: "{{ $patient->id }}",
            description: description, 
            amount: amount, 
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Saved!',
            'New payment successfully added.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });
      } else {
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Fields must not be empty.'
        })
      }
  });

  $(".delete-charge").unbind().click(function(){
    id = $(this).data('id');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          method: "DELETE",
          url: "/patient/delete_charge/" + id,
          data: { 
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Deleted!',
            'Record has been deleted.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });
      }
    })
  });

  $(".delete-payment").unbind().click(function(){
    id = $(this).data('id');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          method: "DELETE",
          url: "/patient/delete_payment/" + id,
          data: { 
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Deleted!',
            'Record has been deleted.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });
      }
    })
  });

  $(".delete-detail").unbind().click(function(){
    id = $(this).data('id');

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          method: "DELETE",
          url: "/patient/delete_detail/" + id,
          data: { 
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Deleted!',
            'Record has been deleted.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });
      }
    })
  });

});
</script>
@endsection
