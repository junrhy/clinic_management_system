@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-notes-medical" aria-hidden="true"></i> Patients</div>

                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('patient/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Patient</a>
                    <br><br>
                    <table class="table">
                      <tr>
                        <th width="30%">First Name</th>
                        <th width="30%">Last Name</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($patients as $patient_key => $patient_item): ?>
                      <tr>
                        <td>{{ $patient_item->first_name }}</td>
                        <td>{{ $patient_item->last_name }}</td>
                        <td>
                            <a class='btn btn-success' href="{{ route('patient.show',$patient_item->id) }}"><i class="fa fa-notes-medical" aria-hidden="true"></i> Show</a>
                            <a class='btn btn-warning' href="{{ route('patient.edit',$patient_item->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            <a class="btn btn-danger delete-patient" data-id="{{ $patient_item->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $(".delete-patient").unbind().click(function(){
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
          url: "/patient/" + id,
          data: { 
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
    })
  });
});
</script>
@endsection
