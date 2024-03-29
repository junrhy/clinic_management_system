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

  .appointment-row:hover td {
    background-color: #fcf8e3;
  }
</style>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th>#</th>
				<th>Time</th>
				<th>Lastname, Firstname</th>
        <th>Contact No.</th>
				<th>Doctor</th>
			</tr>
		</thead>
		<tbody>
			@if($scheduled->count() > 0)
				@foreach($scheduled as $key => $schedule)
				<tr style="cursor:pointer;" 
						data-id="{{ $schedule->id }}" 
            data-patient_id="{{ $schedule->patient->id }}"
						data-patient="{{ $schedule->patient->last_name }}, {{ $schedule->patient->first_name }}" 
						data-clinic="{{ $schedule->clinic_id }}" 
						data-doctor="{{ $schedule->doctor_id }}" 
						data-service="{{ $schedule->service }}" 
						data-schedule_date="{{ date('m/d/Y', strtotime($schedule->date_scheduled)) }}" 
						data-schedule_time="{{ date('g:i a', strtotime($schedule->time_scheduled)) }}"  
						data-status="{{ $schedule->status }}" 
						data-detail="{{ strip_tags($schedule->notes) }}" class="appointment-row">

					<td class="appointment"><input type="checkbox" name="appointment-action" data-id="{{ $schedule->id }}"></td>
					<td class="appointment">{{ $key + 1 }}</td>
					<td class="appointment"><span style="font-family: sans-serif;color: #008385">{{ date('g:i a', strtotime($schedule->time_scheduled)) }}</span></td>
					<td class="appointment">{{ $schedule->patient->last_name }}, {{ $schedule->patient->first_name }}</td>
          <td class="appointment"><i class="fa fa-phone"></i> <span style="font-family: sans-serif;">{{ $schedule->patient->contact_number }}</span></td>
					<td class="appointment"><i class="fa fa-user-md"></i> {{ $schedule->doctor }}</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td colspan="8" class="text-center">No appointment found on this date.</td>
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
      var is_feature_allowed = "{{ App\Model\FeatureUser::is_feature_allowed('edit_appointment', Auth::user()->id) }}";

      if (is_feature_allowed == 'hidden') {
          return false;
      }

      $('#appointment_patient_id').val($(this).parent().data('patient_id'));
	    $('#appointment_patient_name').html($(this).parent().data('patient'));
	    $("select[name='appointment_clinic']").val($(this).parent().data('clinic'));
	    $("select[name='appointment_doctor']").val($(this).parent().data('doctor'));
	    $("input[name='appointment_schedule_date']").val($(this).parent().data('schedule_date'));
	    $("input[name='appointment_schedule_time']").val($(this).parent().data('schedule_time'));
	    $("select[name='appointment_status']").val($(this).parent().data('status'));
	    $("textarea[name='notes']").text($(this).parent().data('detail'));
	    $("#btn-save-changes").attr('data-id', $(this).parent().data('id'));


      if ($(this).parent().data('status') == 'Open' || $(this).parent().data('status') == 'In Progress') {
        $("#labelServices").addClass('disabledContent');
        $(".services-holder").addClass('disabledContent');
        $(".next-visit").addClass('disabledContent');
        $("#labelInvoice").addClass('disabledContent');
        $("#invoice-holder").addClass('disabledContent');
        $(".total-fees-group").addClass('disabledContent');
        $(".amount-paid").addClass('disabledContent');
      }

	 	  $('#edit_appointment_modal').modal('show');
 	  }
  });

  $("#btn-save-changes").unbind().click(function(){
    id = $("#btn-save-changes").data('id');
    clinic_id = $("select[name='appointment_clinic']").val();
    doctor_id = $("select[name='appointment_doctor']").val();
    
    date_scheduled = $("input[name='appointment_schedule_date']").val();
    time_scheduled = $("input[name='appointment_schedule_time']").val();
    status = $("select[name='appointment_status']").val();
    notes = $("textarea[name='notes']").val();

    var service = "";
    $(".service-selected").map(function() {
        if (service == "") {
          service = this.innerHTML;
        } else {
          service = service + ", " + this.innerHTML;
        }
    }).get();

    var invoice_item = [];
    var amount_paid = $("input[name='payment").val();
    $(".invoice-item").each(function() {
      var service = $(this).data('invoice_service');
      var row_count = $(this).data('row_count');
      var qty = $('#invoice-qty'+row_count).val();
      var price = $('#invoice-price'+row_count).val();

      invoice_item['service'] = service;
      invoice_item['qty'] = qty;
      invoice_item['price'] = price;

      invoice_item.push({"service" : service, "qty" : qty, "price" : price});
    });

    $.ajax({
      method: "POST",
      url: "/patient/update_detail/" + id,
      data: { 
        clinic_id: clinic_id, 
        doctor_id: doctor_id, 
        service: service, 
        date_scheduled: date_scheduled, 
        time_scheduled: time_scheduled, 
        status: status, 
        notes: notes,
        invoice_item: invoice_item,
        amount_paid: amount_paid,
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
    clinic_id = $("select[name='new_appointment_clinic']").val();
    doctor_id = $("select[name='new_appointment_doctor']").val();
    date_scheduled = $("input[name='new_appointment_schedule_date']").val();
    time_scheduled = $("input[name='new_appointment_schedule_time']").val();
    status = $("select[name='new_appointment_status']").val();
    notes = $("textarea[name='new_notes']").val();

    $.ajax({
          method: "POST",
          url: "/patient/create_detail",
          data: { 
            patient_id: id,
            clinic_id: clinic_id, 
            doctor_id: doctor_id, 
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

