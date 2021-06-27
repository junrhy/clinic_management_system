@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<style type="text/css">
    .m-t-0 {
        margin-top: 0px;
    }

    .m-b-5 {
        margin-bottom: 5px;
    }

    .card {
        width:13em;
        text-align: center;
        padding:2em;
        border-radius: 5px;
        border: 2px solid #ffffff;
    }

    .clinic-appointments {
        border: 2px solid #ffffff;
    }

    .card-color-1 {
        background-color: #fec4d2;
    }

    .card-color-2 {
        background-color: #c4effe;
    }

    .card-color-3 {
        background-color: #c4fed3;
    }

    .text-color-1 {
        color: #fec4d2;
    }

    .text-color-2 {
        color: #2ec7fc;
    }

    .text-color-3 {
        color: #c4fed3;
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
                        <h2>Dashboard <small class="text-muted">Quickview of your company performance</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#ffffff;">Dashboard</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if($clinic_count == 0 || $doctor_count == 0 || $service_count == 0 || $patient_count == 0)
                    <h3 class="row col-md-12">Things you need to do first</h3>
                    <div class="row col-md-12">
                        <ol class="row">
                            @if($clinic_count == 0)
                            <li><a href="/clinic/create">Add clinic details</a></li>
                            @endif

                            @if($doctor_count == 0)
                            <li><a href="/doctor/create">Add clinic doctors</a></li>
                            @endif

                            @if($service_count == 0)
                            <li><a href="/service/create">Add clinic services</a></li>
                            @endif

                            @if($patient_count == 0)
                            <li><a href="/patient/create">Add patients</a></li>
                            @endif
                        </ol>
                    </div>
                    @endif

                    <h3 class="row col-md-12">Overview</h3>
                    <div class="row col-md-12">
                        <div class="card card-color-2 col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $clinic_count }}</h2>
                            <p class="text-muted">Clinics</p>
                        </div>
                        
                        <div class="card card-color-1 col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $doctor_count }}</h2>
                            <p class="text-muted">Doctors</p>
                        </div>

                        <div class="card card-color-3 col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $patient_count }}</h2>
                            <p class="text-muted">Patients</p>
                        </div>
                    </div>


                    <h3 class="row col-md-12">Today's Appointment</h3>

                    @if($clinic_count == 0)
                    <div class="row col-md-4 table-responsive clinic-appointments">
                        <table class="table table-striped">
                            <tr>
                                <td colspan="4">You didn't add your clinic details yet.</td>
                            </tr>
                        </table>
                    </div>
                    @endif

                    @foreach($clinics as $clinic)
                    <div class="row col-md-4 table-responsive clinic-appointments">
                        <strong class="text-color-2"><i class="fa fa-clinic-medical"></i> {{ $clinic->name }}</strong>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Time</th>
                                    <th>Lastname, Firstname</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $date = \Carbon\Carbon::now()->format('Y-m-d'); 
                                    $client_id = auth()->user()->client_id;
                                    $clinic_id = $clinic->id;
                                ?>

                                @foreach($clinic->appointments($client_id, $date, $clinic_id) as $key => $appointment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><span style="font-family: sans-serif;color: #008385">{{ date('g:i a', strtotime($appointment->time_scheduled)) }}</span></td>
                                    <td>{{ $appointment->patient->last_name }}, {{ $appointment->patient->first_name }}</td>
                                    <td><i class="fa fa-user-md"></i> {{ $appointment->doctor }}</td>
                                    <td>{{ $appointment->status }}</td>
                                </tr>
                                @endforeach

                                @if($clinic->appointments($client_id, $date, $clinic_id)->count() == 0)
                                <tr>
                                    <td colspan="5" align="center">{{ $clinic->name }} doesn't have appointment today.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                     </div>
                    @endforeach
 
                </div>
            </div>
        </div>
    </div>
</div>
@if( App\Model\FeatureUser::is_feature_allowed('dashboard', Auth::user()->id) == 'hidden' )
<div class="modalOverlay">
@endif
@endsection
