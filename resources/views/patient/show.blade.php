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
                      <h4 class="row" style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-user-md" aria-hidden="true"></i> Medical</h4>
                        <ul class="nav nav-tabs">
                          <li class="nav-item active"><a class="nav-link" data-toggle="tab" href="#home">Records</a></li>
                          <li><a data-toggle="tab" href="#menu1">Archived</a></li>
                        </ul>

                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <br>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <th style="width:15%">Created</th>
                                  <th style="width:15%">Clinic</th>
                                  <th style="width:15%">Doctor</th>
                                  <th style="width:15%">Service Type</th>
                                  <th style="width:15%">Appointment</th>
                                  <th style="width:15%">Attachments</th>
                                  <th style="width:1%;text-align:center;">Action</th>
                                </thead>

                                <tbody>
                                @if(count($details) > 0)
                                  @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $detail->created_at->format('M d, Y') }}</td>
                                        <td>{{ $detail->clinic }}</td>
                                        <td>{{ $detail->doctor }}</td>
                                        <td>{{ $detail->service }}</td>
                                        <td>
                                          @if($detail->date_scheduled != '')
                                            {{ date('M d, Y', strtotime($detail->date_scheduled)) }}&nbsp;&nbsp;
                                            {{ date('h:i a', strtotime($detail->time_scheduled)) }}
                                          @else
                                            &nbsp;
                                          @endif
                                        </td>
                                        <td>
                                          @if(!empty($detail->attachment_number))
        
                                              @foreach($detail->attachment as $attachment)
                                                <small class="attachment">
                                                  <a href="{{ asset('storage/'. $attachment->path .'/'. $attachment->filename) }}" target="_blank">
                                                     <i class="fa fa-paperclip" aria-hidden="true"></i> {{ $attachment->filename }}
                                                  </a>
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

                                    @if(!empty($detail->notes))
                                    <tr>
                                      <td colspan="7">
                                        <?php echo $detail->notes ?>
                                      </td>
                                    </tr>
                                    @endif

                                    
                                  @endforeach
                                @else
                                  <tr>
                                    <td class="text-center" colspan="7">Use the form below to add new record.</td>
                                  </tr>
                                @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div id="menu1" class="tab-pane fade">
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <th style="width:15%">Created</th>
                                    <th style="width:15%">Clinic</th>
                                    <th style="width:15%">Doctor</th>
                                    <th style="width:15%">Service Type</th>
                                    <th style="width:15%">Appointment</th>
                                    <th style="width:15%">Attachments</th>
                                    <th style="width:1%;text-align:center;">Action</th>
                                  </thead>

                                  <tbody>
                                  @if(count($archived_details) > 0)
                                    @foreach ($archived_details as $archive_detail)
                                      <tr>
                                          <td>{{ $archive_detail->created_at->format('M d, Y') }}</td>
                                          <td>{{ $archive_detail->clinic }}</td>
                                          <td>{{ $archive_detail->doctor }}</td>
                                          <td>{{ $archive_detail->service }}</td>
                                          <td>
                                            @if($archive_detail->date_scheduled != '')
                                              {{ date('M d, Y', strtotime($archive_detail->date_scheduled)) }}&nbsp;&nbsp;
                                              {{ date('h:i a', strtotime($archive_detail->time_scheduled)) }}
                                            @else
                                              n/a
                                            @endif
                                          </td>
                                          <td>
                                            @if(!empty($archive_detail->attachment_number))
          
                                                @foreach($archive_detail->attachment as $attachment)
                                                  <small class="attachment">
                                                    <a href="{{ asset('storage/'. $attachment->path .'/'. $attachment->filename) }}" target="_blank">
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

                                    @if(!empty($archive_detail->notes))
                                    <tr>
                                      <td colspan="7">
                                        <?php echo $detail->notes ?>
                                      </td>
                                    </tr>
                                    @endif
                                  @else
                                    <tr>
                                      <td class="text-center" colspan="7">No archived record.</td>
                                    </tr>
                                  @endif
                                  </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>

                  <div class="row col-md-6 {{ App\Model\FeatureUser::is_feature_allowed('add_patient_detail', Auth::user()->id) }}">
                    <div class="form-group col-md-3">
                      {{ Form::label('clinic', 'Clinic') }}
                      {{ Form::select('clinic', $clinics, '', ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group col-md-3">
                      {{ Form::label('doctor', 'Doctor') }}
                      {{ Form::select('doctor', $doctors, '', ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group col-md-3">
                      {{ Form::label('service', 'Service Type') }}
                      {{ Form::select('service', $services, '', ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group col-md-12">
                      {{ Form::label('notes', 'Notes') }}
                      {{ Form::textarea('notes', null, ['id' => 'notes','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'maxlength' => 300, 'placeholder' => 'Limit to 300 characters only', 'style' => 'resize:none']) }}
                    </div>
                    <div class="form-group col-md-6">
                      {{ Form::label('attachment', 'Attachment') }}
                      <div class="row">
                        <div class="col-md-12">
                          <form id="form-patient-detail-upload" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="attachment_number" value="{{ \Illuminate\Support\Str::random(6) }}">
                              <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                              <input type="file" name="attachment[]" multiple>
                              {{ csrf_field() }}
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-6 {{ App\Model\FeatureUser::is_feature_allowed('add_appointment', Auth::user()->id) }}">
                      {{ Form::checkbox('checkbox_visit', 'Yes') }}
                      {{ Form::label('checkbox_visit', 'Set Appointment') }}
                      <div class="row">
                        <div class="col-md-6">
                          {{ Form::text('schedule', null, array('id' => 'date_scheduled', 'class' => 'form-control', 'placeholder' => 'mm/dd/yyyy', 'disabled')) }}
                        </div>
                        <div class="col-md-6">
                          {{ Form::text('schedule_time', null, array('id' => 'time_scheduled', 'class' => 'form-control', 'placeholder' => '2:00 pm', 'disabled')) }}
                        </div>
                      </div>
                    </div>
       
                    <div class="col-md-offset-9 col-md-3">
                      <a class="btn btn-primary btn-round btn-block" id="record_detail"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
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
      $("#time_scheduled").prop("disabled", !$(this).is(":checked"));
      $("#time_scheduled").val('');
  });

  $("#record_detail").click(function(){
      var clinic = $("#clinic").val();
      var doctor = $("#doctor").val();
      var service = $("#service").val();
      var notes = $("#notes").val();
      var date_scheduled = $("#date_scheduled").val();
      var time_scheduled = $("#time_scheduled").val();

      if ($("input[name='attachment[]").get(0).files.length != 0) {
        var attachment_number = $("input[name='attachment_number']").val();
      } else {
        var attachment_number = '';
      }
      

      $.ajax({
        method: "POST",
        url: "/patient/create_detail",
        data: { 
          patient_id: "{{ $patient->id }}",
          clinic: clinic, 
          doctor: doctor, 
          service: service, 
          notes: notes, 
          attachment_number: attachment_number,
          date_scheduled: date_scheduled, 
          time_scheduled: time_scheduled,
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
});
</script>
@endsection
