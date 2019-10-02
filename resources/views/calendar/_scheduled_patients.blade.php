<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Time</th>
			<th>Name</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		@foreach($scheduled as $key => $schedule)
		<tr class="appointment" style="cursor:pointer;" data-patient="{{ $schedule->patient->first_name }} {{ $schedule->patient->last_name }}" data-detail="{{ $schedule->detail }}">
			<td>{{ $key + 1 }}</td>
			<td><span style="font-family: sans-serif;color: green">{{ date('h:i a', strtotime($schedule->time_scheduled)) }}</span></td>
			<td>{{ $schedule->patient->first_name }} {{ $schedule->patient->last_name }}</td>
			<td>{{ str_limit($schedule->detail, 30) }}</td>
		</tr>
		@endforeach
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
        <h5 class="modal-title">Appointment Details</h5>
      </div>
      <div class="modal-body">
      	<strong>Patient Name: </strong><span id="appointment_patient_name"></span>
      	<br><br>
        <div id="appointment_modal_content"></div>
      </div>
      <div class="modal-footer">
	     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$(".appointment").unbind().click(function(){
		$('#appointment_patient_name').html($(this).data('patient'));
		$('#appointment_modal_content').html($(this).data('detail'));
	    $('#appointment_modal').modal('show');
	});
});
</script>