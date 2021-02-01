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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="card col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $clinic_count }}</h2>
                            <p class="text-muted">Clinics</p>
                        </div>
                        
                        <div class="card col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $doctor_count }}</h2>
                            <p class="text-muted">Doctors</p>
                        </div>

                        <div class="card col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $patient_count }}</h2>
                            <p class="text-muted">Patients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if( App\Model\FeatureUser::is_feature_allowed('dashboard', Auth::user()->id) == 'hidden' )
<div class="modalOverlay">
@endif
@endsection
