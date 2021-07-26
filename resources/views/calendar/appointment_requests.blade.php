@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<style media="screen">
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
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Appointment Requests <small class="text-muted">Manage your patient appointment requests</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Appointment Requests</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-calendar"></i> Appointment Requests</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <th>Patient Name</th>
                            <th>Requested Date</th>
                            <th>Requested Time</th>
                            <th>Clinic</th>
                            <th>Doctor</th>
                            <th>Purpose</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($appointment_requests as $appointment_request)
                            <tr>
                                <td>{{ $appointment_request->patient->last_name }}, {{ $appointment_request->patient->first_name }}</td>
                                <td>{{ date('M d, Y ( D )', strtotime($appointment_request->date_scheduled)) }}</td>
                                <td><span style="font-family: sans-serif;color: #008385">{{ date('g:i a', strtotime($appointment_request->time_scheduled)) }}</span></td>
                                <td>{{ $appointment_request->clinic_model->name }}</td>
                                <td><i class="fa fa-user-md"></i> {{ $appointment_request->doctor_model->first_name }} {{ $appointment_request->doctor_model->last_name }}</td>
                                <td>{{ $appointment_request->notes }}</td>
                                <td>
                                  <a class="approved" data-id="{{ $appointment_request->id }}"><i class="fa fa-check"></i> Approved</a> |
                                  <a class="denied" data-id="{{ $appointment_request->id }}"><i class="fa fa-times"></i> Denied</a>
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
@endsection

@section('page_level_footer_script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js"></script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".approved").unbind().click(function(){
        id = $(this).data('id');

        $.ajax({
            method: "POST",
            url: "/appointment/request/approved",
            data: { 
              id: id,
              _token: "{{ csrf_token() }}" 
            }
        })
        .done(function( msg ) {
            Swal.fire(
              'Approved!',
              'Appointment is now approved.',
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
                  url: "/appointment/request/denied/" + id,
                  data: { 
                    _token: "{{ csrf_token() }}" 
                  }
                })
                .done(function( msg ) {
                  Swal.fire(
                    'Denied!',
                    'Appointment request has been denied.',
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
