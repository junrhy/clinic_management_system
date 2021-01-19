<!-- Modal -->
<div class="modal fade" id="add_patient_record_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title">Add Record</h5>
      </div>
      <div class="modal-body">
         <div class="col-md-12 {{ App\Model\FeatureUser::is_feature_allowed('add_patient_detail', Auth::user()->id) }}">
              <div class="form-group col-md-4">
                {{ Form::label('clinic', 'Clinic') }}
                {{ Form::select('clinic', $clinics, '', ['class' => 'form-control']) }}
              </div>

              <div class="form-group col-md-4">
                {{ Form::label('doctor', 'Doctor') }}
                {{ Form::select('doctor', $doctors, '', ['class' => 'form-control']) }}
              </div>

              <div class="form-group col-md-4">
                {{ Form::label('service', 'Service Type') }}
                {{ Form::select('service', $services, '', ['class' => 'form-control']) }}
              </div>

              <div class="form-group col-md-12">
                {{ Form::label('notes', 'Notes') }}
                {{ Form::textarea('notes', null, ['id' => 'notes','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'maxlength' => 300, 'placeholder' => 'Limit to 300 characters only', 'style' => 'resize:none']) }}
              </div>

              <div class="form-group col-md-6">
                {{ Form::label('attachment', 'Attachment') }}
                <div class="row">
                  <div class="col-md-12">
                    <form id="form-patient-detail-upload" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="attachment_number" value="{{ \Illuminate\Support\Str::random(6) }}">
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <input type="file" name="attachment[]" multiple>
                        {{ csrf_field() }}
                    </form>
                  </div>
                </div>
              </div>

              <div class="form-group col-md-6 {{ App\Model\FeatureUser::is_feature_allowed('add_appointment', Auth::user()->id) }}">
                {{ Form::checkbox('checkbox_visit', 'Yes') }}
                {{ Form::label('checkbox_visit', 'Set Appointment') }}
                <div class="row">
                  <div class="col-md-7">
                    {{ Form::text('schedule', null, array('id' => 'date_scheduled', 'class' => 'form-control', 'placeholder' => 'mm/dd/yyyy', 'disabled')) }}
                  </div>
                  <div class="col-md-5">
                    {{ Form::text('schedule_time', null, array('id' => 'time_scheduled', 'class' => 'form-control', 'placeholder' => '2:00 pm', 'disabled')) }}
                  </div>
                </div>
              </div>
          </div>
          <br><br><br>
          <br><br><br>
          <br><br><br>
          <br><br><br>
          <br><br>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
            <a class="btn btn-primary btn-round" id="record_detail"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $("#add_patient_record").click(function(){
    $('#add_patient_record_modal').modal('show');
  });
});
</script>