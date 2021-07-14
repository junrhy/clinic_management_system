@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .approved {
    color: green;
    cursor: pointer;
  }

  .denied {
    color: red;
    cursor: pointer;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <h2>Patient Registration Requests <small class="text-muted">All patients who register from the patient registration form will be flag as under review before it will be added to the patient records.</small></h2>
                    </div>            
                    <div class="col-lg-5 col-md-5 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Patient Registration Requests</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-notes-medical" aria-hidden="true"></i> Review Registration Request</div>

                <div class="panel-body">
                    @if( in_array(Auth::user()->client->account_type, ['free', 'basic', 'premium']) )
                        Patient Registration Form: 
                        <a href="/profile/{{ Auth::user()->client->slug }}" target="_BLANK">
                            <i class="fa fa-external-link"></i> Open
                        </a><br><br>
                    @endif

                    <table class="table">
                        <thead>
                            <th>Date Registered</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>Contact</th>
                            <th>Username</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            <tr>
                                <td>{{ date('M d, Y', strtotime($patient->created_at)) }}</td>
                                <td>{{ $patient->first_name }}</td>
                                <td>{{ $patient->last_name }}</td>
                                <td>{{ $patient->gender }}</td>
                                <td><span style="font-family: sans-serif;">{{ $patient->dob->format('M d, Y') }}</span></td>
                                <td><span style="font-family: sans-serif;">{{ $patient->dob->age }}</span></td>
                                <td><span style="font-family: sans-serif;">{{ $patient->contact_number }}</span></td>
                                <td><span style="font-family: sans-serif;">{{ $patient->user->username }}</span></td>
                                <td>
                                    <a class="approved" data-id="{{ $patient->id }}"><i class="fa fa-check"></i> Approved</a> |
                                    <a class="denied" data-id="{{ $patient->id }}"><i class="fa fa-times"></i> Denied</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if( App\Model\FeatureUser::is_feature_allowed('patients', Auth::user()->id) == 'hidden' )
<div class="modalOverlay"></div>
@endif
@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".approved").unbind().click(function(){
        id = $(this).data('id');

        $.ajax({
            method: "POST",
            url: "/patient_registration/request/approved",
            data: { 
              id: id,
              _token: "{{ csrf_token() }}" 
            }
        })
        .done(function( msg ) {
            Swal.fire(
              'Approved!',
              'Patient record is now added.',
              'success'
            ).then((result) => {
              location.reload();
            });
        });
    });

    $(".denied").unbind().click(function(){
        id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deny it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                  method: "DELETE",
                  url: "/patient_registration/request/denied/" + id,
                  data: { 
                    _token: "{{ csrf_token() }}" 
                  }
                })
                .done(function( msg ) {
                  Swal.fire(
                    'Denied!',
                    'Registration request has been denied.',
                    'success'
                  ).then((result) => {
                    location.reload();
                  });
                });
            }
        });
    });
});
</script>
@endsection
