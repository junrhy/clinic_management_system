@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
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
  .fc-state-highlight {
    background:#ffcccc;
  }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-calendar"></i> Calendar</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                              <h4>Appointments</h4>
                              <div id="patient_list"></div>
                        </div>
                        <div class="col-md-6">
                            <div id='calendar'></div>
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

  $('#calendar').fullCalendar({
      firstDay: 1,
      minDate:0,
      viewRender: function(currentView){
          $('.fc-past').filter(
            function(index){
            return moment( $(this).data('date') ).isBefore(moment(),'day')
          }).addClass('fc-other-month');
      },
      dayClick: function(calEvent, jsEvent, view) {
          $(".fc-state-highlight").removeClass("fc-state-highlight");

          if ($(jsEvent.target).hasClass('fc-day')) {
            $(jsEvent.target).addClass("fc-state-highlight");

            $.ajax({
              method: "POST",
              url: "/calendar/scheduled_patients",
              data: { 
                date: $(this).data('date'),
                _token: "{{ csrf_token() }}" 
              }
            })
            .done(function( response ) {
              $("#patient_list").html(response);
            });
          }
      }
  });

  $(function(){
    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var today = d.getFullYear() + '/' +
        (month<10 ? '0' : '') + month + '/' +
        (day<10 ? '0' : '') + day;

    $.ajax({
      method: "POST",
      url: "/calendar/scheduled_patients",
      data: { 
        date: today,
        _token: "{{ csrf_token() }}" 
      }
    })
    .done(function( response ) {
      $("#patient_list").html(response);
    });
  });
});
</script>
@endsection
