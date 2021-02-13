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
    background:#FF6065;
    color:#FFFFFF;
    border:1px solid #ccc;
  } 

  .basic-plan-head {
    background:#636b6f;
    color:#FFFFFF;
    border-left:1px solid #ccc;
    border-right:1px solid #ccc;
  }

  .free {
    color: #FF6065;
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
        <div class="col-md-8 col-md-offset-2" style="margin-top: 5px;">
        	<br>
            <div class="panel panel-default">
                <div class="panel-heading">
                   <div class="row">
                    <img src="/img/brand/bluewhalecms.png" class="col-md-12 col-md-offset-3" style="width: 350px;">
                   </div>
                </div>

                <div class="panel-body" style="font-family: 'Nunito';text-align: justify;">
                    <h3 style="text-align: center;">
                      Welcome to <span style="font-weight: bold;">Bluewhale Clinic Management Software.</span> We are a start-up Software Development Company that primarily focus on building software solutions for doctor's who decide to have their own clinic. We are dedicated that our software service can help you to easily manage your clinic operation. 
                    </h3>
 
                    <h2 align="center">See Our Pricing</h2>
                    <div class="table-responsive col-md-12">
                        <table class="table">
                            <tr>
                              <td style="border: 0;"></td>
                              <td class="free-plan-head text-center" width="25%">Free</td>
                              <td class="basic-plan-head text-center" width="25%">Basic</td>
                            <tr>
                              <td>Manage Appointments</td>
                              <td class="free-plan text-center">Yes</td>
                              <td class="basic-plan text-center">Yes</td>
                            </tr>
                            <tr>
                              <td>Manage Patients</td>
                              <td class="free-plan text-center">100</td>
                              <td class="basic-plan text-center">Unlimited</td>
                            </tr>
                            <tr>
                              <td>Manage Clinics</td>
                              <td class="free-plan text-center">Yes</td>
                              <td class="basic-plan text-center">Yes</td>
                            </tr>
                            <tr>
                              <td>Manage Staffs</td>
                              <td class="free-plan text-center">Yes</td>
                              <td class="basic-plan text-center">Yes</td>
                            </tr>
                            <tr>
                              <td>Manage Services</td>
                              <td class="free-plan text-center">Yes</td>
                              <td class="basic-plan text-center">Yes</td>
                            </tr>
                            <tr>
                              <td>Manage Doctors</td>
                              <td class="free-plan text-center">Yes</td>
                              <td class="basic-plan text-center">Yes</td>
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
                        <label>Want to try out?</label>
                        @if ($domain == null)
                        <a href="{{ route('register') }}" class="btn btn-upgrade btn-lg btn-block">
                            <span style="color: #fff;">Sign Up for FREE!</span>
                        </a>
                        @endif
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <label>Already a member?</label>
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
