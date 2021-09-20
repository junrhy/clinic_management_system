@extends('layouts.login')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

@section('content')
<style type="text/css">
    .img-navbar-brand {
        height: 80px;
        margin-right: 100px;
    }

    .btn-appointment {
        display: inline-block;
        margin-bottom: 0;
        font-weight: normal;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        touch-action: manipulation;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.6;
        border-radius: 4px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background: #DAA520;
        color: #ffffff;
        border:none;
        padding-top: 14px;
        padding-bottom: 14px;
    }

    .btn-appointment:hover {
        background: #ffffff;
        color: #DAA520;
        border: 1px solid #DAA520;
    }

    .btn-appointment:active {
        background: #DAA520;
        color: #ffffff; 
    }

    .btn-appointment:active:focus {
        color: #ffffff; 
        background-color: #DAA520; 
    }

    .nav-link {
        color: #000000;
    }

    .navbar-nav > li > a:hover {
        background: #ffffff;
        color: #DAA520;
    }

    .section {
        text-align: center;
        color: #262626;
        margin-top: 15px;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="navbar-header">
    @if ($domain && $domain->client->logo != "")
        @if(env('FILESYSTEM_DRIVER') == 'spaces')
        <a href="/"><img class="img-navbar-brand" src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/' . $domain->client->logo) }}"></a>
        @endif

    @else
        <h3 class="text-center" style="font-weight:bold;color:#01d8da;font-family: 'Nunito';">
          <i class="fa fa-clinic-medical"></i> CMS <br>
          <small>Clinic Management Software</small>
        </h3>
    @endif
    </div>

    <ul class="nav navbar-nav" style="margin-top:10px;">
        <li class="nav-item"><a class="nav-link" href="#doctors">Doctors</a></li>
        <li class="nav-item"><a class="nav-link" href="#clinicschedule">Clinic Schedule</a></li>
        <li class="nav-item"><a class="nav-link" href="/patient-registration-form?profile={{ $domain->client->slug }}&cid={{ $domain->client->id }}">Patient Registration</a></li>
        <li class="nav-item" style="margin-right: 100px;"><a class="nav-link" href="{{ route('login') }}">Account Login</a></li>
        <li class="nav-item"><a class="btn btn-appointment" href="#bookanappointment" style="margin-left:15px;">Book an appointment </a></li>
    </ul>
</div>

<div class="container-fluid">
    <div class="row table-responsive" style="text-align: center;background-color: #262626;">
        <img class="" style="height:80vh;border-top: 2px solid #262626;border-bottom: 2px solid #262626;" src="/img/client-images/armamentodentalstudio/bg.jpeg">
    </div>
</div>

<div class="container">
    <div class="col-md-12">
        <br>
        <br>
        <hr>
        <br>
        <br>
        <h1 class="section" id="doctors">Doctors</h1>
        <br>
        <br>
        <br>
    </div>

    <div class="col-md-12 table-responsive">
        <hr>
        <h1 class="section" id="clinicschedule">Clinic Schedule</h1>
        <table class="table table-schedule" border="1">
            <tr>
                <th></th>
                <th style="text-align: center;">Monday</th>
                <th style="text-align: center;">Tuesday</th>
                <th style="text-align: center;">Wednesday</th>
                <th style="text-align: center;">Thursday</th>
                <th style="text-align: center;">Friday</th>
                <th style="text-align: center;">Saturday</th>
                <th style="text-align: center;">Sunday</th>
            </tr>
            <tr>
                <td>8:00AM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="center" rowspan="10">Closed</td>
            </tr>
            <tr>
                <td>9:00AM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>10:00AM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>11:00AM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>12:00AM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>1:00PM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>2:00PM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>3:00PM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>4:00PM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>5:00PM</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
        </table>
    </div>

    <div class="col-md-12">
        <br>
        <br>
        <hr>
        <h1 class="section" id="bookanappointment">Book an Appointment</h1>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    </div>
</div>

<div class="container-fluid">
    <div class="row" style="text-align:center;padding: 10px;background-color: #262626;color: #ffffff;">
        Copyright &copy; Armamento Dental Studio. All rights reserved.
    </div>
</div>
@endsection
