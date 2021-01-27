<table class="table table-striped">
  <thead>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Date of Birth</th>
    <th>Age</th>
    <th>Contact</th>
    <th>Username</th>
    <th>Clinical Record</th>
    <th>Action</th>
  </thead>
@if($patients->count() > 0)
  <?php foreach ($patients as $patient_key => $patient_item): ?>
  <tr>
    <td>{{ $patient_item->first_name }}</td>
    <td>{{ $patient_item->last_name }}</td>
    <td>{{ $patient_item->gender }}</td>
    <td><span style="font-family: sans-serif;">{{ $patient_item->dob->format('M d, Y') }}</span></td>
    <td><span style="font-family: sans-serif;">{{ $patient_item->dob->age }}</span></td>
    <td><span style="font-family: sans-serif;">{{ $patient_item->contact_number }}</span></td>
    <td><span style="font-family: sans-serif;">{{ $patient_item->user->username }}</span></td>
    <td><a class="show-patient {{ App\Model\FeatureUser::is_feature_allowed('view_patient_record', Auth::user()->id) }}" href="{{ route('patient.show',$patient_item->id) }}"><i class="fa fa-notes-medical" aria-hidden="true"></i> View Record</a></td>
    <td>
      <div>
        <a class="update-patient {{ App\Model\FeatureUser::is_feature_allowed('edit_patient', Auth::user()->id) }}" href="{{ route('patient.edit',$patient_item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <span class="update-patient {{ App\Model\FeatureUser::is_feature_allowed('delete_patient', Auth::user()->id) }}"> | </span>
        <a class="delete-patient {{ App\Model\FeatureUser::is_feature_allowed('delete_patient', Auth::user()->id) }}" data-id="{{ $patient_item->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
      </div>
   </td>
  </tr>
  <?php endforeach; ?>
@else
  <tr>
    <td colspan="9" class="text-center">No record found</td>
  </tr>
@endif
</table>