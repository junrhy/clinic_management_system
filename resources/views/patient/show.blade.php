@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<style type="text/css">
  .delete-link, .archive-detail , .unarchive-link, .edit-link {
    color: gray;
    font-size:12pt;
    cursor: pointer;
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

  .show_link, .print-link, .download-link {
    font-size: 9pt;
    color: #008385;
    cursor: pointer;
  }

  .nodisplay {
    display: none;
  }

  .btn-round-custom {
    border-width: 1px;
    border-radius: 30px !important;
    padding: 5px 8px;
  }

  .btn-round-custom:hover {
    background-color: #00cfd1;
    color: #ffffff;
  }

  .created_by {
    font-size: 8pt;
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
                        <h2>Patient Information <small class="text-muted">Organize your Patient's Records</small></h2>
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
                  <div class="row" style="font-size:10pt;">
                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-address-card"></i> Patient Information</h4>

                    <table class="">
                      <tr>
                        <td class="col-md-2 text-right">First Name:</td>
                        <td><span style="font-family: sans-serif;">{{ $patient->first_name }}</span></td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Last Name:</td>
                        <td><span style="font-family: sans-serif;">{{ $patient->last_name }}</span></td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Date of Birth:</td>
                        <td><span style="font-family: sans-serif;">{{ $patient->dob->format('M d, Y') }}</span></td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Age:</td>
                        <td><span style="font-family: sans-serif;">{{ $patient->dob->age }}</span></td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Gender:</td>
                        <td><span style="font-family: sans-serif;">{{ $patient->gender }}</span></td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Email:</td>
                        <td><span style="font-family: sans-serif;">{{ $patient->email }}</span></td>
                      </tr>
                      <tr>
                        <td class="col-md-2 text-right">Contact No.:</td>
                        <td><span style="font-family: sans-serif;">{{ $patient->contact_number }}</span></td>
                      </tr>
                    </table>
                  </div>

                  <div class="form-group col-md-12">
                    <div class="row" style="margin-top:30px;">
                      <h4 class="row" style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;">
                        <i class="fa fa-user-md" aria-hidden="true"></i> Medical
                        <span id="add_patient_record" class="{{ App\Model\FeatureUser::is_feature_allowed('add_patient_detail', Auth::user()->id) }} btn-white btn-icon btn-round-custom" style="cursor: pointer;">
                            <i class="fa fa-plus"></i>
                        </span>
                      </h4>
                        <ul class="nav nav-tabs">
                          <li class="nav-item active"><a class="nav-link" data-toggle="tab" href="#home">Records</a></li>
                          <li><a data-toggle="tab" href="#menu1">Archived</a></li>
                        </ul>

                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <div class="" align="right">
                              <a id="download-medical-records" href="/patient/download_medical_record/{{ $patient->id }}" class="download-link">
                                <i class="fa fa-download" aria-hidden="true"></i> Download
                              </a>
                            </div>
                            <div class="table-responsive" id="medical-record-table">
                              <table class="table table-striped">
                                <thead>
                                  <th style="width:13%">Created</th>
                                  <th style="width:12%">Clinic</th>
                                  <th style="width:10%">Doctor</th>
                                  <th style="width:15%">Services</th>
                                  <th style="width:15%">Remarks</th>
                                  <th style="width:10%">Next Visit</th>
                                  <th style="width:15%">Attachments</th>
                                  <th style="width:1%;text-align:center;">Action</th>
                                </thead>

                                <tbody>
                                @if(count($details) > 0)
                                  @foreach ($details as $detail)
                                    <tr>
                                        <td>
                                          {{ $detail->created_at->format('M d, Y') }} - {{ $detail->created_at->format('h:ia') }}<br>
                                          <span class="created_by">Encoded by {{ $detail->created_by }}</span>
                                        </td>
                                        <td>{{ $detail->clinic }}</td>
                                        <td>{{ $detail->doctor }}</td>
                                        <td><small>{{ $detail->service }}</small></td>
                                        <td><small>{!! $detail->notes !!}</small></td>
                                        <td>
                                          @if($detail->date_scheduled != '')
                                            {{ date('M d, Y', strtotime($detail->date_scheduled)) }}&nbsp;&nbsp;
                                            {{ date('h:i a', strtotime($detail->time_scheduled)) }}
                                          @else
                                            
                                          @endif
                                        </td>
                                        <td>
                                          @if(!empty($detail->attachment_number))
        
                                              @foreach($detail->attachment as $attachment)
                                                <small class="attachment">
                                                  @if(env('FILESYSTEM_DRIVER') == 'spaces')
                                                      <a href="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/client'. auth()->user()->client_id .'/'. $attachment->path .'/'. $attachment->filename) }}" target="_blank">
                                                         <i class="fa fa-paperclip" aria-hidden="true"></i> {{ $attachment->filename }}
                                                      </a>
                                                  @else
                                                      <a href="{{ asset('storage/'. $attachment->path .'/'. $attachment->filename) }}" target="_blank">
                                                         <i class="fa fa-paperclip" aria-hidden="true"></i> {{ $attachment->filename }}
                                                      </a>
                                                  @endif

                                                  
                                                </small>
                                                <small class="delete-text delete-attachment" data-id="{{ $attachment->id }}" data-filename="{{ $attachment->filename }}">delete</small>
                                                <br>
                                              @endforeach
                                          
                                          @endif
                                        </td>
                                        <td class="text-center">
                                          <a class="delete-link delete-detail {{ App\Model\FeatureUser::is_feature_allowed('delete_patient_detail', Auth::user()->id) }}" data-id="{{ $detail->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a> | 
                                          <a class="archive-link archive-detail {{ App\Model\FeatureUser::is_feature_allowed('archive_patient_detail', Auth::user()->id) }}" data-id="{{ $detail->id }}"><i class="fa fa-archive" aria-hidden="true" title="Archive"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                                @else
                                  <tr>
                                    <td class="text-center" colspan="8">No record found.</td>
                                  </tr>
                                @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div id="menu1" class="tab-pane fade">
                            <br>
                            <div class="table-responsive" id="medical-record-archived-table">
                                <table class="table table-striped">
                                  <thead>
                                    <th style="width:13%">Created</th>
                                    <th style="width:20%">Clinic</th>
                                    <th style="width:10%">Doctor</th>
                                    <th style="width:15%">Services</th>
                                    <th style="width:20%">Remarks</th>
                                    <th style="width:10%">Next Visit</th>
                                    <th style="width:15%">Attachments</th>
                                    <th style="width:1%;text-align:center;">Action</th>
                                  </thead>

                                  <tbody>
                                  @if(count($archived_details) > 0)
                                    @foreach ($archived_details as $archive_detail)
                                      <tr>
                                          <td>{{ $archive_detail->created_at->format('M d, Y') }} - {{ $archive_detail->created_at->format('h:ia') }}<br>
                                              <span class="created_by">Encoded by {{ $archive_detail->created_by }}</span>
                                          </td>
                                          <td>{{ $archive_detail->clinic }}</td>
                                          <td>{{ $archive_detail->doctor }}</td>
                                          <td><small>{{ $archive_detail->service }}</small></td>
                                          <td><small>{!! $archive_detail->notes !!}</small></td>
                                          <td>
                                            @if($archive_detail->date_scheduled != '')
                                              {{ date('M d, Y', strtotime($archive_detail->date_scheduled)) }}&nbsp;&nbsp;
                                              {{ date('h:i a', strtotime($archive_detail->time_scheduled)) }}
                                            @else
                                              
                                            @endif
                                          </td>
                                          <td>
                                            @if(!empty($archive_detail->attachment_number))
          
                                                @foreach($archive_detail->attachment as $attachment)
                                                  <small class="attachment">
                                                    <a href="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/client'. auth()->user()->client_id .'/'. $attachment->path .'/'. $attachment->filename) }}" target="_blank">
                                                       <i class="fa fa-paperclip" aria-hidden="true"></i> {{ $attachment->filename }}
                                                    </a>
                                                  </small>
                                                  <small class="delete-text delete-attachment" data-id="{{ $attachment->id }}" data-filename="{{ $attachment->filename }}">delete</small>
                                                  <br>
                                                @endforeach
       
                                            @endif
                                          </td>
                                          <td class="text-center">
                                            <a class="delete-link delete-detail {{ App\Model\FeatureUser::is_feature_allowed('delete_patient_detail', Auth::user()->id) }}" data-id="{{ $archive_detail->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a> | 
                                            <a class="unarchive-link unarchive-detail {{ App\Model\FeatureUser::is_feature_allowed('unarchive_patient_detail', Auth::user()->id) }}" data-id="{{ $archive_detail->id }}"><i class="fa fa-undo" aria-hidden="true" title="Restore"></i></a>
                                          </td>
                                      </tr>
                                    @endforeach
                                  @else
                                    <tr>
                                      <td class="text-center" colspan="8">No record found.</td>
                                    </tr>
                                  @endif
                                  </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>

                  @include('patient._add_patient_record_modal')
                  
                  <div class="form-group col-md-12">
                    <div class="row">
                      <h4 class="row" style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;">
                        <i class="fa fa-file-text" aria-hidden="true"></i> Prescriptions
                        <span id="add_prescription" class="{{ App\Model\FeatureUser::is_feature_allowed('add_patient_prescription', Auth::user()->id) }} btn-white btn-icon btn-round-custom" style="cursor: pointer;">
                            <i class="fa fa-plus"></i>
                        </span>
                      </h4>
                      <div class="row col-md-6">
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <th style="width:13%">Created</th>
                              <th style="width:13%">Clinic</th>
                              <th style="width:13%">Doctor</th>
                              <th style="width:5%">Prescription</th>
                              <th style="width:1%;text-align:center;">Action</th>
                            </thead>

                            <tbody>
                            @if(count($prescriptions) > 0)
                              @foreach ($prescriptions as $prescription)
                              <tr>
                                <td>{{ $prescription->created_at->format('M d, Y') }} - {{ $prescription->created_at->format('h:ia') }}<br>
                                    <span class="created_by">Encoded by {{ $prescription->created_by }}</span>
                                </td>
                                <td>{{ $prescription->clinic }}</td>
                                <td>{{ $prescription->doctor }}</td>
                                <td>
                                  <a class="print-link print-prescription" data-id="{{ $prescription->id }}"><i class="fa fa-file-prescription" aria-hidden="true"></i> Preview</a>
                                </td>
                                <td class="text-center">
                                  <a class="delete-link delete-prescription {{ App\Model\FeatureUser::is_feature_allowed('delete_patient_prescription', Auth::user()->id) }}" data-id="{{ $prescription->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                              </tr>
                              @endforeach
                            @else
                              <tr>
                                <td class="text-center" colspan="8">No record found.</td>
                              </tr>
                            @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                  </div>
                </div>

                @include('patient._add_prescription_modal')
                @include('patient._print_preview')
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
      $("#time_scheduled").prop("disabled", !$(this).is(":checked"));
      $("#time_scheduled").val('');
  });

  $("#record_detail").click(function(){
      var clinic_id = $('select[name=clinic]').val();
      var doctor_id = $('select[name=doctor]').val();
      var notes = $("#notes").val();
      var date_scheduled = $("#date_scheduled").val();
      var time_scheduled = $("#time_scheduled").val();
      var is_set_custom_total_amount = "{{ App\Model\ClientSettings::is_setting_checked('set_custom_total_amount', Auth::user()->client_id ) }}";


      if (clinic_id == null) {
        $('select[name=clinic]').addClass('required-textfield');
        return false;
      } else {
        $('select[name=clinic]').removeClass('required-textfield');
      }

      if (doctor_id == null) {
        $('select[name=doctor]').addClass('required-textfield');
        return false;
      } else {
        $('select[name=doctor]').removeClass('required-textfield');
      }

      if ($("input[name='attachment[]").get(0).files.length != 0) {
        var attachment_number = $("input[name='attachment_number']").val();
      } else {
        var attachment_number = '';
      }


      var invoice_item = [];
      var invoice_total_amount = $("#total-fees").text();
      var amount_paid = $("input[name='payment']").val();
      $(".invoice-item").each(function() {
        var service = $(this).data('service');
        var row_count = $(this).data('row_count');
        var qty = $('#invoice-qty'+row_count).val();

        if (is_set_custom_total_amount == '') {
            var price = $('#invoice-price'+row_count).val();

            invoice_item['service'] = service;
            invoice_item['qty'] = qty;
            invoice_item['price'] = price;

            invoice_item.push({"service" : service, "qty" : qty, "price" : price});
        } else {
            invoice_item['service'] = service;
            invoice_item['qty'] = qty;

            invoice_item.push({"service" : service, "qty" : qty});
        }
        
      });


      $.ajax({
        method: "POST",
        url: "/patient/create_detail",
        data: { 
          patient_id: "{{ $patient->id }}",
          clinic_id: clinic_id, 
          doctor_id: doctor_id, 
          notes: notes,
          attachment_number: attachment_number,
          date_scheduled: date_scheduled, 
          time_scheduled: time_scheduled,
          invoice_item: invoice_item,
          invoice_total_amount: invoice_total_amount,
          amount_paid: amount_paid,
          _token: "{{ csrf_token() }}" 
        }
      })
      .done(function( msg ) {
        $("#form-patient-detail-upload").submit();

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

  $(".delete-attachment").unbind().click(function(){
    id = $(this).data('id');
    filename = $(this).data('filename');

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
          url: "/attachment/delete/" + id,
          data: { 
            filename: filename,
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Deleted!',
            'Attachment has been deleted.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });
      }
    })
  });

  $(".archive-detail").unbind().click(function(){
    id = $(this).data('id');
    
    $.ajax({
      method: "POST",
      url: "/patient/archive_detail/" + id,
      data: { 
        _token: "{{ csrf_token() }}" 
      }
    })
    .done(function( msg ) {
      Swal.fire(
        'Archived!',
        'Record has been archived.',
        'success'
      ).then((result) => {
        location.reload();
      });
    });
  });

  $(".unarchive-detail").unbind().click(function(){
    id = $(this).data('id');
    
    $.ajax({
      method: "POST",
      url: "/patient/unarchive_detail/" + id,
      data: { 
        _token: "{{ csrf_token() }}" 
      }
    })
    .done(function( msg ) {
      Swal.fire(
        'Restored!',
        'Record has been restored.',
        'success'
      ).then((result) => {
        location.reload();
      });
    });
  });

  $("#form-patient-detail-upload").submit(function(event){
    event.preventDefault();
    var formData = new FormData($("#form-patient-detail-upload")[0]);
    $.ajax({
        url: "{{ url('/patient/upload_detail') }}",
        type: 'POST',              
        data: formData,
        processData: false,
        contentType: false,
        success: function(result)
        {
            location.reload();
        },
        error: function(data)
        {
            console.log(data);
        }
    });
  });

  $(".print-prescription").unbind().click(function(){
    id = $(this).data('id');

    $.ajax({
      method: "POST",
      url: "/patient/print_prescription",
      data: { 
        id: id,
        _token: "{{ csrf_token() }}" 
      }
    })
    .done(function( html ) {
        $("#print_preview_content").html(html);
        $("#print_preview_modal").modal('show');
    });
  });

  function downloadFile(response) {
      var blob = new Blob([response], {type: 'application/pdf'})
      var url = URL.createObjectURL(blob);
      location.assign(url);
  } 
});
</script>
@endsection
