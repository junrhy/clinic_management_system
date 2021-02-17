@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<style media="screen">
  .ui-datepicker {
    width: 100%;
  }

  .fc-past {
    background: #fff2f4;
  }

  .fc-today {
    background: none !important;
  }

  .fc-state-highlight {
    background:#fcf8e3;
    color:#fff;
  }

  .fc-content {
    text-align: center;
  }

  .fc-title {
    font-size: 10pt;
  }

  .bulk-delete-appointment:hover {
    color: red;
    text-decoration: none;
    cursor: pointer;
  }

  .current_clinic {
    border: 2px solid #01d8da;
  }

  .appointment-list {
    border: 1px solid #ccc;
    padding: 1px;
  }

  .nav-tabs {
    border-bottom: 1px solid #01d8da;
  }

  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    border-radius: 0px;
    border-color: #01d8da;
    background-color: #01d8da;
    color: #ffffff;
    font-weight: bold;
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
                        <h2>Appointment <small class="text-muted">Manage your patient appointments</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10 {{ App\Model\FeatureUser::is_feature_allowed('add_appointment', Auth::user()->id) }}" id="add-appointment" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Patients</li>
                            <li class="breadcrumb-item active">Appointment</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-calendar"></i> Appointments</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row col-md-4 col-md-offset-3">
                              {{ Form::select('current_clinic', $clinics, isset($_GET['clinic']) ? $_GET['clinic'] : null, array('class' => 'form-control current_clinic', 'placeholder' => 'Select Clinic')) }}
                              <br>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id='calendar'></div>
                            <br>
                        </div>
                        <div class="col-md-7">
                          <div class="appointment-list">
                            <div class="pull-right">
                              <span class="bulk-delete-appointment hidden"><i class="fa fa-trash"></i> Remove</span>
                            </div>

                            <ul class="nav nav-tabs">
                                <li class="nav-item active" data-status="open">
                                    <a data-toggle="tab" id="open_tab" href="#open">Open</a>
                                </li>
                                <li class="nav-item" data-status="in_progress">
                                    <a data-toggle="tab" id="in_progress_tab" href="#in_progress">In Progress</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="open" class="tab-pane fade in active">
                                    <div id="patient_list_open"></div>
                                </div>
                                <div id="in_progress" class="tab-pane fade in">
                                    <div id="patient_list_in_progress"></div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="status" value="{{ Request::get('status') }}">

@include('calendar._edit_modal')
@include('calendar._add_modal')

@if( App\Model\FeatureUser::is_feature_allowed('appointment', Auth::user()->id) == 'hidden' )
<div class="modalOverlay"></div>
@endif
@endsection

@section('page_level_footer_script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js"></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

  $('#calendar').fullCalendar({
      firstDay: 1,
      minDate: 0,
      header: {
          left:   'title',
          center: '',
          right:  'prev,next'
      },
      views: {
          month: {
            titleFormat: 'MMMM YYYY',
          }
      }, 
      viewRender: function(currentView){
          $('.fc-past').filter(
            function(index){
            return moment( $(this).data('date') ).isBefore(moment(),'day')
          }).addClass('fc-other-month');
      },
      dayClick: function(calEvent, jsEvent, view) {
          $(".fc-day").removeClass("fc-state-highlight");
          $(".fc-day").removeClass("fc-today");

          $("#progress").removeClass("done");
          $({property: 0}).animate({property: 105}, {
              duration: 2000,
              step: function() {
                  var _percent = Math.round(this.property);
                  $('#progress').css('width',  _percent+"%");
                  if(_percent == 105) {
                      $("#progress").addClass("done");
                  }
              }
          });

          if ($(jsEvent.target).hasClass('fc-day')) {
                $(jsEvent.target).addClass("fc-state-highlight");

                clinic = $("select[name='current_clinic']").val();
                status = $("input[name='status']").val();

                var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + "?status=" + status + "&calendar_date="+$(this).data('date')+'&clinic='+clinic;    
                window.history.pushState({ path: refresh }, '', refresh);

                // open appointments
                $.ajax({
                  method: "POST",
                  url: "/calendar/scheduled_patients",
                  data: { 
                    date: $(this).data('date'),
                    status: 'Open',
                    clinic_id: $("select[name='current_clinic']").val(),
                    _token: "{{ csrf_token() }}" 
                  }
                })
                .done(function( response ) {
                  $("#patient_list_open").html(response);
                });

                // in progress appointments
                $.ajax({
                  method: "POST",
                  url: "/calendar/scheduled_patients",
                  data: { 
                    date: $(this).data('date'),
                    status: 'In Progress',
                    clinic_id: $("select[name='current_clinic']").val(),
                    _token: "{{ csrf_token() }}" 
                  }
                })
                .done(function( response ) {
                  $("#patient_list_in_progress").html(response);
                });

          }
      }
  });

  $(".nav-item").click(function(){
      clinic = $("select[name='current_clinic']").val();

      status = $(this).data('status');

      var calendar_date = $(".fc-state-highlight").data("date");

      var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?status='+ status + '&calendar_date='+calendar_date+'&clinic='+clinic;    
      window.history.pushState({ path: refresh }, '', refresh);

      $("input[name='status']").val(status);
  });

  function show_all_appointments() {
      var eventSources = $('#calendar').fullCalendar('clientEvents');
      var len = eventSources.length;
      for (var i = 0; i < len; i++) { 
          eventSources[i].remove(); 
      } 

      $.ajax({
          method: "POST",
          url: "/calendar/get_all_appointments",
          data: { 
            clinic_id: $("select[name='current_clinic']").val(),
            _token: "{{ csrf_token() }}" 
          }
      })
      .done(function( data ) {
          //console.log(data);
          $.each(data, function(i, item) {

              var event_name = 'patient';
              if (item.total > 1) {
                event_name = 'patients';
              }

              $('#calendar').fullCalendar('renderEvent', {
                  title: item.total + ' ' + event_name,
                  start: item.date_scheduled,
                  allDay: true,
                  color: '#00cfd1',
                  textColor: '#fff'
              });
          });
      });
  }

  $(function(){
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var today = d.getFullYear() + '-' +
        (month<10 ? '0' : '') + month + '-' +
        (day<10 ? '0' : '') + day;


    var calendar_date = "{{ Request::get('calendar_date') }}";

    if (calendar_date == "") {
        calendar_date = today;
    }

    $("#{{ Request::get('status') }}_tab").click();

    // open appointments
    $.ajax({
      method: "POST",
      url: "/calendar/scheduled_patients",
      data: { 
        date: calendar_date,
        status: 'Open',
        clinic_id: $("select[name='current_clinic']").val(),
        _token: "{{ csrf_token() }}" 
      }
    })
    .done(function( response ) {
      $("#patient_list_open").html(response);
    });

    // in progress appointments
    $.ajax({
      method: "POST",
      url: "/calendar/scheduled_patients",
      data: { 
        date: calendar_date,
        status: 'In Progress',
        clinic_id: $("select[name='current_clinic']").val(),
        _token: "{{ csrf_token() }}" 
      }
    })
    .done(function( response ) {
      $("#patient_list_in_progress").html(response);
    });

    // status
    status = $("input[name='status']").val();
    clinic = $("select[name='current_clinic']").val();

    if (status == '') { status = 'open'}

    var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?status=' + status + '&calendar_date='+calendar_date+'&clinic='+clinic;  

    window.history.pushState({ path: refresh }, '', refresh);

    $("input[name='status']").val(status);

    // highlighting
    $('#calendar').fullCalendar('gotoDate', moment(calendar_date) );
    $('.fc-day[data-date="' + calendar_date + '"]').addClass('fc-state-highlight');

    if ($('.fc-day[data-date="' + calendar_date + '"]').hasClass('fc-today')) {
      $('.fc-day[data-date="' + calendar_date + '"]').removeClass('fc-today');
    }

    // show all appointments
    show_all_appointments();
  });

  $("#add-appointment").click(function(){
    $('#add_appointment_modal').modal('show');
  });

  $("select[name='current_clinic']").on('change', function() {
      var d = new Date();

      var month = d.getMonth()+1;
      var day = d.getDate();

      var today = d.getFullYear() + '-' +
          (month<10 ? '0' : '') + month + '-' +
          (day<10 ? '0' : '') + day;

      var calendar_date = "{{ Request::get('calendar_date') }}";

      if (calendar_date == "") {
          calendar_date = today;
      }

      status = $("input[name='status']").val();
      clinic = $("select[name='current_clinic']").val();

      if (status == '') { status = 'open'}

      var refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?status=' + status + '&calendar_date='+calendar_date+'&clinic='+clinic;  

      window.history.pushState({ path: refresh }, '', refresh);

      location.reload();
  });
});
</script>


@endsection
