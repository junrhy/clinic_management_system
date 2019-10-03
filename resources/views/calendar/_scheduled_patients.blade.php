<style type="text/css">
	.custom-text-input {
		height: 25px;
	    padding: 6px 12px;
	    margin:5px;
	    background-color: #fff;
	    background-image: none;
	    border: 1px solid #ccd0d2;
	    border-radius: 4px;
	}

	.ui-datepicker {
		width: 200px;
	}
</style>
<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Time</th>
			<th>Name</th>
			<th>Service Type</th>
		</tr>
	</thead>
	<tbody>
		@if($scheduled->count() > 0)
			@foreach($scheduled as $key => $schedule)
			<tr class="appointment" style="cursor:pointer;" 
					data-id="{{ $schedule->id }}" 
					data-patient="{{ $schedule->patient->first_name }} {{ $schedule->patient->last_name }}" 
					data-service="{{ $schedule->service }}" 
					data-schedule_date="{{ date('m/d/Y', strtotime($schedule->date_scheduled)) }}" 
					data-schedule_time="{{ date('h:i a', strtotime($schedule->time_scheduled)) }}"  
					data-detail="{{ strip_tags($schedule->notes) }}">

				<td>{{ $key + 1 }}</td>
				<td><span style="font-family: sans-serif;color: green">{{ date('h:i a', strtotime($schedule->time_scheduled)) }}</span></td>
				<td>{{ $schedule->patient->first_name }} {{ $schedule->patient->last_name }}</td>
				<td>{{ $schedule->service }}</td>
			</tr>
			@endforeach
		@else
			<tr>
				<td colspan="4" class="text-center">No appointment on this date.</td>
			</tr>
		@endif
	</tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="appointment_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Appointment</h5>
      </div>
      <div class="modal-body">
      	<table width="100%">
      		<tr>
      			<td width="19%" align="right" style="padding-right: 15px;">Patient Name: </td>
      			<td><span id="appointment_patient_name"></span></td>
      		</tr>
  			<tr>
      			<td width="19%" align="right" style="padding-right: 15px;">Service Type: </td>
      			<td>{{ Form::text('appointment_service_type', null, array('class' => 'custom-text-input')) }}</td>
      		</tr>
  			<tr>
      			<td width="19%" align="right" style="padding-right: 15px;">Schedule: </td>
      			<td>
      				{{ Form::text('appointment_schedule_date', null, array('class' => 'custom-text-input', 'style' => 'width:103px', 'readonly')) }}
      				{{ Form::text('appointment_schedule_time', null, array('class' => 'custom-text-input', 'style' => 'width:85px')) }}
      			</td>
      		</tr>
      	</table>
      	<br>
      	<h5>Notes</h5>
      	{{ Form::textarea('notes', null, ['id' => 'notes','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'maxlength' => 300, 'placeholder' => 'Limit to 300 characters only', 'style' => 'resize:none']) }}
        
      </div>
      <div class="modal-footer">
  		 <button type="button" id="btn-save-changes" data-id="" class="btn btn-primary btn-round" data-dismiss="modal">Save Changes</button>
	     <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
	  </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("input[name='appointment_schedule_date']").datepicker({
    	minDate: 0
  	});

	$(".appointment").unbind().click(function(){
		$('#appointment_patient_name').html($(this).data('patient'));
		$("input[name='appointment_service_type']").val($(this).data('service'));
		$("input[name='appointment_schedule_date']").val($(this).data('schedule_date'));
		$("input[name='appointment_schedule_time']").val($(this).data('schedule_time'));
		$("textarea[name='notes']").text($(this).data('detail'));
		$("#btn-save-changes").attr('data-id', $(this).data('id'));
	    $('#appointment_modal').modal('show');
	});

	$("#btn-save-changes").click(function(){
		id = $("#btn-save-changes").data('id');
		service = $("input[name='appointment_service_type']").val();
		date_scheduled = $("input[name='appointment_schedule_date']").val();
		time_scheduled = $("input[name='appointment_schedule_time']").val();
		notes = $("textarea[name='notes']").val();

		$.ajax({
          method: "POST",
          url: "/patient/update_detail/" + id,
          data: { 
            service: service, 
            date_scheduled: date_scheduled, 
            time_scheduled: time_scheduled, 
            notes: notes,
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Saved!',
            'Changes successfully saved.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });

	});
});
</script>