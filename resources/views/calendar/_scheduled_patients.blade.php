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

	.app-action {
		margin: 0px 5px;
	}
</style>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>#</th>
				<th>Time</th>
				<th>Name</th>
				<th>Clinic</th>
				<th>Doctor</th>
				<th>Service Type</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@if($scheduled->count() > 0)
				@foreach($scheduled as $key => $schedule)
				<tr style="cursor:pointer;" 
						data-id="{{ $schedule->id }}" 
						data-patient="{{ $schedule->patient->first_name }} {{ $schedule->patient->last_name }}" 
						data-clinic="{{ $schedule->clinic }}" 
						data-doctor="{{ $schedule->doctor }}" 
						data-service="{{ $schedule->service }}" 
						data-schedule_date="{{ date('m/d/Y', strtotime($schedule->date_scheduled)) }}" 
						data-schedule_time="{{ date('g:i a', strtotime($schedule->time_scheduled)) }}"  
						data-status="{{ $schedule->status }}" 
						data-detail="{{ strip_tags($schedule->notes) }}">

					<td class="appointment"><input type="checkbox" name="appointment-action" data-id="{{ $schedule->id }}"></td>
					<td class="appointment">{{ $key + 1 }}</td>
					<td class="appointment"><span style="font-family: sans-serif;color: green">{{ date('g:i a', strtotime($schedule->time_scheduled)) }}</span></td>
					<td class="appointment">{{ $schedule->patient->first_name }} {{ $schedule->patient->last_name }}</td>
					<td class="appointment">{{ $schedule->clinic }}</td>
					<td class="appointment">{{ $schedule->doctor }}</td>
					<td class="appointment">{{ $schedule->service }}</td>
					<td class="appointment">{{ $schedule->status }}</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="8" class="text-center">No appointment on this date.</td>
				</tr>
			@endif
		</tbody>
	</table>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $("input[name='appointment_schedule_date']").datepicker({
    minDate: 0
  });

  $("input[name='new_appointment_schedule_date']").datepicker({
    minDate: 0
  });

  $(".appointment").unbind().click(function(){
  	if($(this).index() != 0){
	    $('#appointment_patient_name').html($(this).parent().data('patient'));
	    $("select[name='appointment_clinic']").val($(this).parent().data('clinic'));
	    $("select[name='appointment_doctor']").val($(this).parent().data('doctor'));
	    $("select[name='appointment_service_type']").val($(this).parent().data('service'));
	    $("input[name='appointment_schedule_date']").val($(this).parent().data('schedule_date'));
	    $("input[name='appointment_schedule_time']").val($(this).parent().data('schedule_time'));
	    $("select[name='appointment_status']").val($(this).parent().data('status'));
	    $("textarea[name='notes']").text($(this).parent().data('detail'));
	    $("#btn-save-changes").attr('data-id', $(this).parent().data('id'));
	 	  $('#edit_appointment_modal').modal('show');
 	  }
  });

  $("#btn-save-changes").unbind().click(function(){
    id = $("#btn-save-changes").data('id');
    clinic = $("select[name='appointment_clinic']").val();
    doctor = $("select[name='appointment_doctor']").val();
    service = $("select[name='appointment_service_type']").val();
    date_scheduled = $("input[name='appointment_schedule_date']").val();
    time_scheduled = $("input[name='appointment_schedule_time']").val();
    status = $("select[name='appointment_status']").val();
    notes = $("textarea[name='notes']").val();

    $.ajax({
          method: "POST",
          url: "/patient/update_detail/" + id,
          data: { 
            clinic: clinic, 
            doctor: doctor, 
            service: service, 
            date_scheduled: date_scheduled, 
            time_scheduled: time_scheduled, 
            status: status, 
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

  $("#btn-submit-appointment").unbind().click(function(){
    id = $("select[name='new_appointment_patient']").val();
    clinic = $("select[name='new_appointment_clinic']").val();
    doctor = $("select[name='new_appointment_doctor']").val();
    service = $("select[name='new_appointment_service_type']").val();
    date_scheduled = $("input[name='new_appointment_schedule_date']").val();
    time_scheduled = $("input[name='new_appointment_schedule_time']").val();
    status = $("select[name='new_appointment_status']").val();
    notes = $("textarea[name='new_notes']").val();

    $.ajax({
          method: "POST",
          url: "/patient/create_detail",
          data: { 
            patient_id: id,
            clinic: clinic, 
            doctor: doctor, 
            service: service, 
            date_scheduled: date_scheduled, 
            time_scheduled: time_scheduled, 
            status: status, 
            notes: notes,
            _token: "{{ csrf_token() }}" 
          }
        })
        .done(function( msg ) {
          Swal.fire(
            'Saved!',
            'Record successfully added.',
            'success'
          ).then((result) => {
            location.reload();
          });
        });

  });

  $("input[name='appointment-action']").unbind().click(function(){
  	var checkedNum = $('input[name="appointment-action"]:checked').length;

  	if (checkedNum > 0) {
  		$(".bulk-delete-appointment").removeClass('hidden');
  	} else {
  		$(".bulk-delete-appointment").addClass('hidden');
  	}
  });

  $(".bulk-delete-appointment").click(function(){
  	var detail_ids = [];

  	$('input[name="appointment-action"]:checked').each(function(i){
      detail_ids[i] = $(this).data('id');
    });

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
          method: "POST",
          url: "/patient/bulk_delete_detail",
          data: { 
          	ids: detail_ids,
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
  	});
  });

});
</script>

