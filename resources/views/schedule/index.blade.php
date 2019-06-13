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
                <div class="panel-heading">Calendar</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                              <h4 class="select_date">Patients</h4>
                              <div id="appointment_list"></div>
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
      viewRender: function(currentView){
          $('.fc-past').filter(
            function(index){
            return moment( $(this).data('date') ).isBefore(moment(),'day')
          }).addClass('fc-other-month');
      },
      dayClick: function(calEvent, jsEvent, view) {
          var selected_date = $.fullCalendar.moment($(this).data('date'));
          alert(selected_date);
      }
  });
});
</script>
@endsection
