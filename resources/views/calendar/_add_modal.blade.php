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
        <table class="table">
          <tr>
            <td width="20%" align="right"><div style="margin-top: 7px;font-weight: bold;">Patient Name: </div></td>
            <td>
              <div class="row col-md-8">
                {{ Form::select('new_appointment_patient', $patients->pluck('fullname', 'id'), null, array('class' => 'form-control')) }}
              </div>
            </td>
          </tr>
          <tr>
            <td align="right"><div style="margin-top: 7px;font-weight: bold;">Clinic: </div></td>
            <td>
              <div class="row col-md-8">
                {{ Form::select('new_appointment_clinic', $clinics->pluck('name', 'id'), null, array('class' => 'form-control')) }}
              </div>
            </td>
          </tr>
          <tr>
            <td align="right"><div style="margin-top: 7px;font-weight: bold;">Doctor: </div></td>
            <td>
              <div class="row col-md-8">
                {{ Form::select('new_appointment_doctor', $doctors->pluck('fullname', 'id'), null, array('class' => 'form-control')) }}
              </div>
            </td>
          </tr>
        <tr>
            <td align="right"><div style="margin-top: 11px;font-weight: bold;">Schedule: </div></td>
            <td>
              {{ Form::text('new_appointment_schedule_date', date("m/d/Y"), array('class' => 'custom-text-input', 'style' => 'width:103px', 'readonly')) }}
              {{ Form::text('new_appointment_schedule_time', '8:00 am', array('class' => 'custom-text-input', 'style' => 'width:85px')) }}
            </td>
          </tr>
          <tr>
            <td align="right"><div style="margin-top: 11px;font-weight: bold;">Status: </div></td>
            <td>{{ Form::select('new_appointment_status', array('Open' => 'Waiting', 'In Progress' => 'Service In Progress'), null, array('class' => 'custom-text-input')) }}</td>
          </tr>
        </table>
        {{ Form::textarea('new_notes', null, ['id' => 'notes','class' => 'form-control', 'rows' => 4, 'cols' => 54, 'maxlength' => 300, 'placeholder' => 'Remarks', 'style' => 'resize:none']) }}
        
      </div>
      <div class="modal-footer">
       <button type="button" id="btn-submit-appointment" data-id="" class="btn btn-primary btn-round" data-dismiss="modal">Add</button>
       <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>