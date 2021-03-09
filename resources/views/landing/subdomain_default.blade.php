@extends('layouts.login')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 m-t-200" style="margin-top: 130px;">
        	<br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        @if ($domain && $domain->client->logo != "")
                            <img src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/'. $domain->client->logo) }}" class="col-md-12 col-sm-12 col-xs-12">
                            <br><br><br><br>
                        @else
                            <h3 class="text-center" style="font-weight:bold;color:#01d8da;font-family: 'Nunito';">
                              <i class="fa fa-clinic-medical"></i> CMS <br>
                              <small>Clinic Management Software</small>
                            </h3>
                        @endif
                    </div>
                </div>

                <div class="panel-body" style="font-family: 'Nunito';font-size: 14pt;text-align: justify;">
                    <h3 style="text-align: left;">Welcome to 
                        @if ($domain)
                            <span style="font-weight: bold;">{{ $domain->client->name }}</span>.
                        @else
                            <span style="font-weight: bold;"> CMS</span>.
                        @endif
                      </h3>
                    <br>
                    We appreciate the trust you have placed in us, and we will strive to provide the high quality of dental care that you expect. Please have your personal information added by our receptionist, Then you will be given a username and password that you can use to login into our system. We look forward to meeting you!
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="label" style="color: #636b6f;">For patient only!</label>
                            <a href="/patient-registration-form" class="btn btn-default btn-lg btn-block">
                                Patient Registration Form
                            </a>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <label class="label" style="color: #636b6f;">Already have an account?</label>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-block">
                                Sign In
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
