<style type="text/css">

</style>
<!-- Modal -->
<div class="modal fade" id="add_prescription_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Add Prescription</h5>
      </div>
      <div class="modal-body">
          <div class="col-md-12 {{ App\Model\FeatureUser::is_feature_allowed('add_prescription', Auth::user()->id) }}">
              <div class="form-group col-md-7">
                {{ Form::label('clinic', 'Clinic') }}
                {{ Form::select('clinic', $clinics, '', ['class' => 'form-control']) }}
              </div>

              <div class="form-group col-md-5">
                {{ Form::label('doctor', 'Doctor') }}
                {{ Form::select('doctor', $doctors, '', ['class' => 'form-control']) }}
              </div>

              <div class="form-group col-md-12">
                {{ Form::label('prescription', 'Prescription') }}
                {{ Form::textarea('prescription', null, ['id' => 'prescription','class' => 'form-control', 'rows' => 10, 'cols' => 54, 'placeholder' => 'Type Prescriptions', 'style' => 'resize:none']) }}
              </div>
          </div>
      </div>
      <br><br><br>
      <br><br><br>
      <br><br><br>
      <br><br><br>
      <br><br><br>
      <br>
      <div class="modal-footer">
            <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
            <a class="btn btn-primary btn-round" id="store_prescription"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $("#add_prescription").click(function(){
    $('#add_prescription_modal').modal('show');
  });

  $(".edit_prescription").unbind().click(function(){

    $('#add_prescription_modal').modal('show');
  });

  $("#store_prescription").click(function(){
      var clinic = $("#clinic").val();
      var doctor = $("#doctor").val();
      var prescription = $("#prescription").val();

      $.ajax({
        method: "POST",
        url: "/patient/store_prescription",
        data: { 
          patient_id: "{{ $patient->id }}",
          clinic: clinic, 
          doctor: doctor,
          prescription: prescription, 
          _token: "{{ csrf_token() }}" 
        }
      })
      .done(function( msg ) {
        location.reload();
      });
  });

  $(".delete-prescription").unbind().click(function(){
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
            url: "/patient/delete_prescription/" + id,
            data: { 
              _token: "{{ csrf_token() }}" 
            }
          })
          .done(function( msg ) {
            Swal.fire(
              'Deleted!',
              'Prescription has been deleted.',
              'success'
            ).then((result) => {
              location.reload();
            });
          });
        }
      })
  });
});
</script>