<style type="text/css">
  body {
    font-size: 10pt;
  }

  .page-break {
    page-break-after: always;
  }
</style>

System Id: {{ Auth::user()->client->name }}<br>
Downloaded on: {{ \Carbon\Carbon::now()->format('M d, Y H:m:i a') }}<br>
Downloaded by: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<br>

<h2>Patient Information</h2>
<table width="100%">
    <tr>
      <td align="left">First Name: <span>{{ $patient->first_name }}</span></td>
      <td width="10%">&nbsp;</td>
      <td align="left">Date of Birth: <span>{{ $patient->dob->format('M d, Y') }}</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="left">Last Name: <span>{{ $patient->last_name }}</span></td>
      <td>&nbsp;</td>
      <td align="left">Age: <span>{{ $patient->dob->age }}</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="left">Gender: <span>{{ $patient->gender }}</span></td>
      <td>&nbsp;</td>
      <td align="left">Email: <span>{{ $patient->email }}</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="left">Contact No.: <span>{{ $patient->contact_number }}</span></td>
      <td>&nbsp;</td>
      <td align="left">Address: <span>{{ $patient->address }}</span></td>
      <td>&nbsp;</td>
    </tr>
</table>

<h2>Medical Records</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="1">
    <thead>
      <tr>
        <th>Date</th>
        <th>Clinic</th>
        <th>Doctor</th>
        <th>Service</th>
        <th>Remarks</th>
        <th>Attachments</th>
      </tr>
    </thead>

    <tbody>
    @if(count($medical_records) > 0)
        @foreach ($medical_records as $medical_record)
          <tr class="page-break">
              <td>{{ $medical_record->created_at->format('M d, Y') }}&nbsp;</td>
              <td>{{ $medical_record->clinic }}&nbsp;</td>
              <td>{{ $medical_record->doctor }}&nbsp;</td>
              <td>{{ $medical_record->service }}&nbsp;</td>
              <td>{{ $medical_record->notes }}&nbsp;</td>
              <td>
                @if(!empty($medical_record->attachment_number))

                    @foreach($medical_record->attachment as $attachment)
                      <small class="attachment">
                        {{ asset('storage/'. $attachment->path .'/'. str_replace(' ', '%20', $attachment->filename) ) }}
                      </small>
                      <br>
                    @endforeach
                
                @endif
                &nbsp;
              </td>
          </tr>
        @endforeach
    @else
      <tr>
        <td colspan="6" align="center">No record found.</td>
      </tr>
    @endif
    </tbody>
</table>