<style type="text/css">
  .custom-text-input {
      height: 35px;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="add_appointment_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">New Appointment</h5>
      </div>
      <div class="modal-body">
        <table width="100%">
          <tr>
            <td width="19%" align="right" style="padding-right: 15px;">Patient Name: </td>
            <td>{{ Form::select('new_appointment_patient', $patients, null, array('class' => 'custom-text-input')) }}</td>
          </tr>
          <tr>
            <td width="19%" align="right" style="padding-right: 15px;">Clinic: </td>
            <td>{{ Form::select('new_appointment_clinic', $clinics, null, array('class' => 'custom-text-input')) }}</td>
          </tr>
          <tr>
            <td width="19%" align="right" style="padding-right: 15px;">Doctor: </td>
            <td>{{ Form::select('new_appointment_doctor', $doctors, null, array('class' => 'custom-text-input')) }}</td>
          </tr>
        <tr>
            <td width="19%" align="right" style="padding-right: 15px;">Service Type: </td>
            <td>{{ Form::select('new_appointment_service_type', $services, null, array('class' => 'custom-text-input')) }}</td>
          </tr>
        <tr>
            <td width="19%" align="right" style="padding-right: 15px;">Schedule: </td>
            <td>
              {{ Form::text('new_appointment_schedule_date', date("m/d/Y"), array('class' => 'custom-text-input', 'style' => 'width:103px', 'readonly')) }}
              {{ Form::text('new_appointment_schedule_time', '8:00 am', array('class' => 'custom-text-input', 'style' => 'width:85px')) }}
            </td>
          </tr>
          <tr>
            <td width="19%" align="right" style="padding-right: 15px;">Status: </td>
            <td>{{ Form::select('new_appointment_status', array('Open' => 'Open', 'In Progress' => 'In Progress', 'Done' => 'Done'), null, array('class' => 'custom-text-input')) }}</td>
          </tr>
        </table>
        <br>
        <h5>Notes</h5>
        {{ Form::textarea('new_notes', null, ['id' => 'notes','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'maxlength' => 300, 'placeholder' => 'Limit to 300 characters only', 'style' => 'resize:none']) }}
        
      </div>
      <div class="modal-footer">
       <button type="button" id="btn-submit-appointment" data-id="" class="btn btn-primary btn-round" data-dismiss="modal">Add</button>
       <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>