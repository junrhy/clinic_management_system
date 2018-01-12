@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css"/>

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
                <div class="panel-heading">Schedule</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="select_date">Appointment Date</h4>
                            <div id="datepicker"></div>

                            <h4 class="select_doctor">Clinic</h4>
                            <div class="clinic_list">
                              {{ Form::select('clinic', ['' => '', 'clinic1' => 'Clinic Name'], null, array('class' => 'form-control')) }}
                            </div>

                            <h4 class="select_doctor">Doctor</h4>
                            <div class="doctor_list">
                              {{ Form::select('doctor', ['' => '', 'doctor1' => 'Doctor Name'], null, array('class' => 'form-control')) }}
                            </div>

                            <h4 class="select_patient">Patient <button class="btn btn-primary btn-sm" type="button">Search</button></h4>
                            <div class="patient_list">

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
</div>
@endsection

@section('page_level_footer_script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

  $("#datepicker").datepicker({
      firstDay: 1
  });

  $('#calendar2').fullCalendar({
      firstDay: 1,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      }
  });

});
</script>
@endsection
