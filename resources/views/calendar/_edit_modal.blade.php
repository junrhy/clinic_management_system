<style type="text/css">
  .custom-text-input {
      height: 35px;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="edit_appointment_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Edit Appointment</h5>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <td width="20%" align="right"><div style="margin-top: 7px;font-weight: bold;">Patient Name: </div></td>
            <td><div  style="margin-top: 3px;font-weight: bold;color: #008385;font-size: 14pt;" id="appointment_patient_name"></div></td>
          </tr>
          <tr>
            <td align="right"><div style="margin-top: 7px;font-weight: bold;">Clinic: </div></td>
            <td>
              <div class="row col-md-8">
                {{ Form::select('appointment_clinic', $clinics, null, array('class' => 'form-control')) }}
              </div>
            </td>
          </tr>
          <tr>
            <td align="right"><div style="margin-top: 7px;font-weight: bold;">Doctor: </div></td>
            <td>
              <div class="row col-md-8">
                {{ Form::select('appointment_doctor', $doctors, null, array('class' => 'form-control')) }}
              </div>
            </td>
          </tr>
        <tr>
            <td align="right"><div style="margin-top: 7px;font-weight: bold;">Service: </div></td>
            <td>
              <div class="row col-md-8">
                {{ Form::select('appointment_service_type', $services, null, array('class' => 'form-control')) }}
              </div>
            </td>
          </tr>
        <tr>
            <td align="right"><div style="margin-top: 11px;font-weight: bold;">Schedule: </div></td>
            <td>
              {{ Form::text('appointment_schedule_date', null, array('class' => 'custom-text-input', 'style' => 'width:103px', 'readonly')) }}
              {{ Form::text('appointment_schedule_time', null, array('class' => 'custom-text-input', 'style' => 'width:85px')) }}
            </td>
          </tr>
          <tr>
            <td align="right"><div style="margin-top: 11px;font-weight: bold;">Status: </div></td>
            <td>{{ Form::select('appointment_status', array('Open' => 'Open', 'In Progress' => 'In Progress', 'Done' => 'Done'), null, array('class' => 'custom-text-input')) }}</td>
          </tr>
        </table>
        {{ Form::textarea('notes', null, ['id' => 'notes','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'maxlength' => 300, 'placeholder' => 'Limit to 300 characters only', 'style' => 'resize:none']) }}
        
      </div>
      <div class="modal-footer">
       <button type="button" id="btn-save-changes" data-id="" class="btn btn-primary btn-round" data-dismiss="modal">Save Changes</button>
       <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>