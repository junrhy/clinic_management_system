<style type="text/css">
  .text-center {
    text-align: center;
  }

  .bg-light {
    background-color: #f8f9fa!important;
    border: 1px solid #fff;
    cursor: pointer;
    border-radius: 30px;
  }

  .bg-selected {
    background-color: #01d8da!important;
    color: #fff;
  }

  .services-holder {
    height: 100px;
    overflow-y: scroll;
    border: 1px solid #eee;
    padding: 3px 2px;
  }
</style>
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
              <div class="form-group col-md-7">
                {{ Form::label('clinic', 'Clinic') }}
                {{ Form::select('clinic', $clinics, '', ['class' => 'form-control']) }}
              </div>

              <div class="form-group col-md-5">
                {{ Form::label('doctor', 'Doctor') }}
                {{ Form::select('doctor', $doctors, '', ['class' => 'form-control']) }}
              </div>

              <div class="form-group col-md-12">
                {{ Form::label('service', 'Services') }}
                <div class="services-holder">
                  @foreach ($services as $key => $service)  
                    <div class="col-md-3 text-center bg-light services">{{ $service->name }}</div>
                  @endforeach
                </div>
              </div>

              <div class="form-group col-md-12">
                {{ Form::label('notes', 'Notes') }}
                {{ Form::textarea('notes', null, ['id' => 'notes','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'placeholder' => 'Limit to 300 characters only', 'style' => 'resize:none']) }}
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

  $(".services").unbind().click(function(){
    if ($(this).hasClass('bg-selected')) {
      $(this).removeClass('bg-selected');
      $(this).removeClass('service-selected');
    } else {
      $(this).addClass('bg-selected');
      $(this).addClass('service-selected');
    }
  });
});
</script>