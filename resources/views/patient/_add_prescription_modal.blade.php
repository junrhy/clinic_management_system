<style type="text/css">
  .required-textfield {
    border: 1px solid red;
  }
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
                <select name="prescription_clinic" class='form-control'>
                  <option value='' disabled>Select Clinic</option>
                  @foreach($clinics as $clinic)
                  <option value="{{ $clinic->name }}">{{ $clinic->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-5">
                {{ Form::label('doctor', 'Doctor') }}
                <select name="prescription_doctor" class='form-control'>
                  <option value='' disabled>Select Doctor</option>
                  @foreach($doctors as $doctor)
                  <option value="{{ $doctor->id }}">{{ $doctor->fullname }}</option>
                  @endforeach
                </select>
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
    $('select[name=prescription_clinic]').val(null);
    $('select[name=prescription_doctor]').val(null);
    
    $('#add_prescription_modal').modal('show');
  });

  $(".edit_prescription").unbind().click(function(){

    $('#add_prescription_modal').modal('show');
  });

  $("#store_prescription").click(function(){
      var clinic = $('select[name=prescription_clinic]').val();
      var doctor = $('select[name=prescription_doctor]').val();
      var prescription = $('textarea[name=prescription]').val();

      if (clinic == null) {
        $('select[name=prescription_clinic]').addClass('required-textfield');
        return false;
      } else {
        $('select[name=prescription_clinic]').removeClass('required-textfield');
      }

      if (doctor == null) {
        $('select[name=prescription_doctor]').addClass('required-textfield');
        return false;
      } else {
        $('select[name=prescription_doctor]').removeClass('required-textfield');
      }

      if (prescription == "") {
        $('textarea[name=prescription]').addClass('required-textfield');
        return false;
      } else {
        $('textarea[name=prescription]').removeClass('required-textfield');
      }

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