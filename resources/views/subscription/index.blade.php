@extends('layouts.app')

@section('page_level_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection

@section('page_level_css')
<style type="text/css">
  .pricing {
    font-family: arial;
  }

  .btn-subscribe {
    background:#FF6065;
    color:#FFFFFF;
    font-weight: bold;
  }

  .btn-subscribe:hover {
    color:#FFFFFF;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.15);
  }

  .subscribed {
    color: #FF6065;
    font-weight: bold;
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
                        <h2>Subscription <small class="text-muted">Upgrade account to enjoy more features.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active">Subscription</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Choose your Plan</div>

                <div class="panel-body">
                  <div class="row">
                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-gear"></i> Subscription Details</h4>
                  </div>
                  You are currently subscribed to: <strong>{{ strtoupper(Auth::user()->client->account_type) }} Plan</strong><br>
                  You're service is active from: <strong>[date subscription started]</strong> to <strong>[subscription ended]</strong> <br>
                  You're next bill will be on: <strong>[subscription ended]</strong>
                  <br><br>
                  <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Plan Name</th>
                            <th>Plan Features</th>
                            <th>Pricing</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Basic Plan</td>
                            <td>
                              Unlimited Appointments <br>
                              Unlimited Patients<br>
                              Unlimited Clinics<br>
                              Unlimited Staffs<br>
                              Unlimited Services<br>
                              Unlimited Doctors<br>
                              Dental Chart
                            </td>
                            <td>
                              <span class="pricing">&#8369;1,500 / month</span><br>
                              <small>Pay yearly to enjoy discount</small>
                            </td>
                            <td>
                              @if(Auth::user()->client->account_type == "basic")
                                <span class="subscribed">Subscribed</span>
                              @else
                                <button class="btn btn-subscribe">Subscribe</button>
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td>Premium Plan</td>
                            <td>
                              <span style="font-weight: bold;">All Basic Plan Features</span> <br>
                              Inventory Management <br>
                              Automated Emails <br>
                              Data Analytics <br>
                            </td>
                            <td>
                              Coming Soon.
                            </td>
                            <td>
                              
                            </td>
                          </tr>
                        </tbody>
                      </table>
                  </div>

                  <div class="row">
                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-file"></i> Billing Statements</h4>
                    <div class="col-md-12">
                      <small>Statements beyond 12 months is archived.</small>
                    </div>
                  </div>
                  <div class="table-responsive row col-md-3">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Statement</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td></td>
                          <td align="center">
                            <a href="">View</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
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
  
});
</script>
@endsection
