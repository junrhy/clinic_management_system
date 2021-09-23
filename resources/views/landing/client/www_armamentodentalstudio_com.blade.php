@extends('layouts.login')

<title>{{ $client->name }}</title>

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
        background: #DAA520;
        color: #ffffff;
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

    .navbar-nav > li > a.nav-link {
        background: #FFFFFF;
        color: #262626;
    }

    .navbar-nav > li > a.nav-link:hover {
        color: #DAA520;
    }

    .navbar-nav > li > a.btn-appointment {
        background: #DAA520;
        color: #FFFFFF;
    }

    .section {
        text-align: center;
        color: #262626;
        margin-top: 15px;
        font-weight: bold;
    }

    .required-textfield {
        border: 1px solid red;
    }

    #booking-notification {
        color: green;
        font-size: 10pt;
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
        <h1 class="section" id="doctors">Doctors</h1>
        <hr>
        <br>
        <br>
        <br>
    </div>

    <div class="col-md-12 table-responsive">
        <h1 class="section" id="clinicschedule">Clinic Schedule</h1>
        <hr>
        <br>
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
        <h1 class="section" id="bookanappointment">Book an Appointment</h1>
        <hr>
        <div align="center">Fill up the form below. A representative will contact you to finalize your appointment.</div>
        <br>
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control">
            </div>

            <div class="col-md-4">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <label>Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control">
            </div>

            <div class="col-md-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <label>Message</label>
                <textarea id="message_body" style="height: 150px; resize: none;" class="form-control"></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <button id="submit-appointment" class="btn btn-appointment btn-block btn-lg" data-client_id="{{ $domain->client->id }}">Book Appointment</button>
            </div>
            <div class="col-md-8 col-md-offset-2" align="center" id="booking-notification"></div>
        </div>
        <br>
        <br>
    </div>

</div>

<div class="container-fluid">
    <div class="row" style="text-align:center;padding: 10px;background-color: #262626;color: #ffffff;">
        Copyright &copy; {{ $domain->client->name }}. All rights reserved.
    </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
    $("#submit-appointment").click(function(){
        var first_name = $("input[name='first_name']").val();
        var last_name = $("input[name='last_name']").val();
        var mobile_number = $("input[name='mobile_number']").val();
        var email = $("input[name='email']").val();
        var subject = $("input[name='subject']").val();
        var message_body = $("#message_body").val();
        var client_id = $(this).data('client_id');

        $("input[name='first_name']").removeClass('required-textfield');
        $("input[name='last_name']").removeClass('required-textfield');
        $("input[name='mobile_number']").removeClass('required-textfield');
        $("input[name='email']").removeClass('required-textfield');
        $("input[name='subject']").removeClass('required-textfield');
        $("#message_body").removeClass('required-textfield');

        if (first_name == "") { $("input[name='first_name']").addClass('required-textfield') }
        if (last_name == "") { $("input[name='last_name']").addClass('required-textfield') }
        if (mobile_number == "") { $("input[name='mobile_number']").addClass('required-textfield') }
        if (email == "") { $("input[name='email']").addClass('required-textfield') }
        if (subject == "") { $("input[name='subject']").addClass('required-textfield') }
        if (message_body == "") { $("#message_body").addClass('required-textfield'); }

        if (first_name != "" && last_name != "" && mobile_number != "" && email != "" && subject != "" && message_body != "") {
            $.ajax({
                method: "POST",
                url: "/landing/book_appointment",
                data: { 
                  client_id: client_id,
                  first_name: first_name,
                  last_name: last_name,
                  mobile_number: mobile_number,
                  email: email,
                  subject: subject,
                  message_body: message_body,
                  _token: "{{ csrf_token() }}" 
                }
            })
            .done(function( src ) {
                $("#booking-notification").text("Appointment request successfully sent.");

                $("input[name='first_name']").val('');
                $("input[name='last_name']").val('');
                $("input[name='mobile_number']").val('');
                $("input[name='email']").val('');
                $("input[name='subject']").val('');
                $("#message_body").val('');
            });
        }
    });
});    
</script>
@endsection
