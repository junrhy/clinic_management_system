@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<style type="text/css">
  .delete-link, .archive-detail , .unarchive-link{
    color: gray;
    font-size:12pt;
  }

  .delete-link:hover {
    color: red;
    font-size:12pt;
  }

  .attachment {
    text-decoration: underline;
    margin-right: 8px;
  }

  .delete-text {
    color: red;
  }

  .delete-text:hover  {
    cursor: pointer;
    text-decoration: underline;
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
                        <h2>Invoices <small class="text-muted">View Invoices</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Patient</li>
                            <li class="breadcrumb-item active">Patient Information</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                  <div class="form-group col-md-12">
                    <div class="row">
                      <h4 class="row" style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-money" aria-hidden="true"></i> Patient Name: {{ $patient->first_name }} {{ $patient->last_name }}</h4>

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
                            <td class="text-right" style="font-family:sans-serif;">{{ number_format($billing_charge->amount, 2) }}</td>
                            <td class="text-center"></span><a class="delete-link delete-charge {{ App\Model\FeatureUser::is_feature_allowed('delete_billing_invoice', Auth::user()->id) }}" data-id="{{ $billing_charge->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                          </tr>
                          @endforeach
                          <tr>
                            <td class="text-right" colspan="2">
                              <strong>Total</strong>
                            </td>
                            <td class="text-right">
                              <strong style="font-family:sans-serif;">&#8369; {{ number_format($billing_charges->sum('amount'), 2) }}</strong>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                        <tfoot class="bg-info {{ App\Model\FeatureUser::is_feature_allowed('add_billing_invoice', Auth::user()->id) }}">
                          <td colspan="4">
                              <div class="row">
                                  <div class="col-md-6 col-md-offset-2">
                                    {{ Form::text('description', null, array('id' => 'charge_description', 'class' => 'form-control', 'maxlength' => 30, 'placeholder' => 'Description')) }}
                                  </div>
                                  <div class="col-md-2">
                                    {{ Form::number('amount', null, array('id' => 'charge_amount', 'class' => 'form-control', 'placeholder' => 'Amount')) }}
                                  </div>

                                  <div class="col-md-2">
                                    <a class="btn btn-primary btn-round btn-block" id="add_charge"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
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
   $("#add_charge").click(function(){
      var description = $("#charge_description").val();
      var amount = $("#charge_amount").val();

      if (description != '' && amount != '') {
        $.ajax({
          method: "POST",
          url: "/invoice/create_billing_charge",
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
          url: "/invoice/delete_charge/" + id,
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
