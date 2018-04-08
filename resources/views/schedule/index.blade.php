@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>

<script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<style media="screen">
  .ui-datepicker {
    width: 100%;
  }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Schedule Appointment</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="select_date">Appointment Date</h4>
                            <div id="calendar1"></div>

                            <h4 class="select_doctor">Clinic</h4>
                            <div class="clinic_list">
                              {{ Form::select('clinic', $clinics, null, array('class' => 'form-control')) }}
                            </div>

                            <h4 class="select_doctor">Doctor</h4>
                            <div class="doctor_list">
                              {{ Form::select('doctor', $doctors, null, array('class' => 'form-control')) }}
                            </div>

                            <h4 class="select_patient">Patient</h4>
                            <div class="patient_list">
                              Patient Name <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".search-patient">Search</button>
                            </div>

                            <h4 class="select_doctor">Color</h4>
                            <div class="color_list">
                              {{ Form::select('color', ['#ffffff;' => 'Default', '#ff9999;' => 'Red', '#4c4cff;' => 'Blue', '#b2ffb2;' => 'Green'], null, array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div id='calendar2'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade search-patient" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Search Patient</h4>
                </div>
                <div class="modal-body">
                  <table id="patients-table">
                    <tr>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Last Name</th>
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Civil Status</th>
                    </tr>
                  </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('page_level_footer_script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js"></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

  $("#calendar1").datepicker({
      firstDay: 1,
      minDate:0,
      onSelect: function(){
          var selected = $(this).val();
          var selected_date = $.fullCalendar.moment(new Date(selected));
          $('#calendar2').fullCalendar('changeView', 'agendaDay');
          $('#calendar2').fullCalendar('gotoDate', selected_date);
      }
  });

  $('#calendar2').fullCalendar({
      firstDay: 1,
      minDate:0,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,'
      },
      viewRender: function(currentView){
          var minDate = moment(),
      		maxDate = moment().add(2,'weeks');
      		// Past
      		if (minDate >= currentView.start && minDate <= currentView.end) {
      			$(".fc-prev-button").prop('disabled', true);
      			$(".fc-prev-button").addClass('fc-state-disabled');
      		}
      		else {
      			$(".fc-prev-button").removeClass('fc-state-disabled');
      			$(".fc-prev-button").prop('disabled', false);
      		}

          $('.fc-past').filter(
            function(index){
            return moment( $(this).data('date') ).isBefore(moment(),'day')
          }).addClass('fc-other-month');
      },
      dayClick: function(calEvent, jsEvent, view) {
          var selected_date = $.fullCalendar.moment($(this).data('date'));
          $('#calendar2').fullCalendar('changeView', 'agendaDay');
          $('#calendar2').fullCalendar('gotoDate', selected_date);
      },
      events: [
        {
          title  : 'event1',
          start  : '2018-04-15 06:00',
          end    : '2018-04-15 06:30'
        }
      ],
      slotLabelInterval: "00:30"
  });

  $('#patients-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: 'patients_list',
      columns: [
          { data: 'first_name', name: 'first_name' },
          { data: 'middle_name', name: 'middle_name' },
          { data: 'last_name', name: 'last_name' },
          { data: 'age', name: 'age' },
          { data: 'gender', name: 'gender' },
          { data: 'civil_status', name: 'civil_status' }
      ]
  });

  $('#patients-table tbody').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
          $(this).removeClass('selected');
      }
      else {
          $('tr.selected').removeClass('selected');
          $(this).addClass('selected');
      }
  });
});
</script>
@endsection
