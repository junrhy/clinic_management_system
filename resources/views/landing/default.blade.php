@extends('layouts.login')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<style type="text/css">
  .free-plan, .basic-plan {
    padding:10px;
    border:1px solid #ccc;
    font-size:10pt;
  }

  .free-plan-head {
    background:#63B5FF;
    color:#FFFFFF;
    border:1px solid #ccc;
  } 

  .basic-plan-head {
    background:#FF6065;
    color:#FFFFFF;
    border-left:1px solid #ccc;
    border-right:1px solid #ccc;
  }

  .free {
    color: #63B5FF;
    font-weight: bold;
    font-family: 'arial';
  }

  .free-plan-foot {
    padding:3px;
  } 

  .basic-plan-foot {
    padding:3px;
    border:1px solid #ccc;
    font-size:13pt;
    color:#FF6065;
    font-family: 'arial';
  }

  .btn-upgrade {
    background:#FF6065;
    color:#FFFFFF;
  }
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 m-t-200" style="margin-top: 50px;">
        	<br>
            <div class="panel panel-default">
                <div class="panel-heading">
                   <div class="row">
                    <h3 class="text-center" style="font-weight:bold;color:#01d8da;font-family: 'Nunito';"><i class="fa fa-clinic-medical"></i> Bluewhale CMS</h3>
                   </div>
                </div>

                <div class="panel-body" style="font-family: 'Nunito';font-size: 14pt;text-align: justify;">
                    <h3 style="text-align: center;">Welcome to <span style="font-weight: bold;">Bluewhale Clinic Management System.</span></h3>
                    <br>
                   
                    <div style="margin-bottom: 50px;margin-left: auto;margin-right: auto;width: 30em;">
                        <table width="100%">
                            <tr>
                              <td></td>
                              <td class="free-plan-head text-center" width="25%">Free</td>
                              <td class="basic-plan-head text-center" width="25%">Basic</td>
                            <tr>
                              <td>Number of Appointments</td>
                              <td class="free-plan text-center">Unlimited</td>
                              <td class="basic-plan text-center">Unlimited</td>
                            </tr>
                            <tr>
                              <td>Number of Patients</td>
                              <td class="free-plan text-center">100</td>
                              <td class="basic-plan text-center">Unlimited</td>
                            </tr>
                            <tr>
                              <td>Number of Clinics</td>
                              <td class="free-plan text-center">Unlimited</td>
                              <td class="basic-plan text-center">Unlimited</td>
                            </tr>
                            <tr>
                              <td>Number of Staffs</td>
                              <td class="free-plan text-center">Unlimited</td>
                              <td class="basic-plan text-center">Unlimited</td>
                            </tr>
                            <tr>
                              <td>Number of Services</td>
                              <td class="free-plan text-center">Unlimited</td>
                              <td class="basic-plan text-center">Unlimited</td>
                            </tr>
                            <tr>
                              <td>Number of Doctors</td>
                              <td class="free-plan text-center">Unlimited</td>
                              <td class="basic-plan text-center">Unlimited</td>
                            </tr>
                            <tr>
                              <td>Dental Chart Feature</td>
                              <td class="free-plan text-center">Yes</td>
                              <td class="basic-plan text-center">Yes</td>
                            </tr>
                            <tr>
                              <td>Subscription Rate</td>
                              <td class="free-plan text-center free">FREE</td>
                              <td rowspan=2 class="basic-plan-foot text-center">&#8369;1,800 / month</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <label>New Client</label>
                        @if ($domain == null)
                        <a href="{{ route('register') }}" class="btn btn-upgrade btn-lg btn-block">
                            <span style="color: #fff;">Sign Up for FREE!</span>
                        </a>
                        @endif
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <label>Existing Client</label>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-block">
                            Sign In
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
