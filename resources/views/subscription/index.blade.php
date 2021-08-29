@extends('layouts.app')

@section('page_level_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection

@section('page_level_css')
<style type="text/css">
  .pricing {
    font-family: arial;
    font-size: 14pt;
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

  .btn-success {
    border: 2px solid green;
    background-color: transparent;
    font-weight: bold;
    color: green;
  }

  #frequency {
    border: 1px solid #00cfd1;
    padding: 5px 10px;
    border-radius: 3px;
  }

  #cancel-subscription {
    color: red;
    text-decoration: none;
    font-size: 10pt;
    cursor: pointer;
  }

  #enable-auto-renew {
    text-decoration: none;
    font-size: 10pt;
    cursor: pointer;
  }

  #cancel-subscription:hover, #enable-auto-renew:hover {
    text-decoration: underline;
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
                        <h2>Subscription Plan's <small class="text-muted">Upgrade your subscription to enjoy more features.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Subscription Plan's</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Choose the best plan for you.</div>

                <div class="panel-body">
                  <div class="row">
                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-gear"></i> Active Subscriptions</h4>
                  </div>
                  <br>
                  <div class="table-responsive row">
                    <div class="col-md-7">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Plan</th>
                            <th>Active from</th>
                            <th>Until</th>
                            <th>Status</th>
                            <th class="text-center">Auto-Renew</th>
                          </tr>
                        </thead>
                        @foreach($subscriptions as $subscription)
                        <tr>
                          <td>{{ ucfirst($subscription->plan) }} Plan</td>
                          <td><span style="font-family: sans-serif;">{{ $subscription->start->format('M-d-Y, h:iA') }}</span></td>
                          <td><span style="font-family: sans-serif;">{{ $subscription->end->format('M-d-Y, h:iA') }}</span></td>
                          <td>
                            @if(\Carbon\Carbon::now()->diffInDays($subscription->end, false) > 0)
                              Will expire in <span style="font-family: sans-serif;">{{ \Carbon\Carbon::now()->diffInDays($subscription->end, false) }}</span> days from now
                            @endif
                          </td>
                          <td align="center">
                            @if($subscription->auto_renew == 1)
                              Yes | 
                              <a id="cancel-subscription" data-subscription_id="{{ $subscription->id }}" data-plan="{{ $subscription->plan }}">Cancel</a>
                            @else
                              No | 
                              <a id="enable-auto-renew" data-subscription_id="{{ $subscription->id }}" data-plan="{{ $subscription->plan }}">Enable</a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>

                   <div class="row">
                    <br><br><br>
                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-arrow-up"></i> Upgrade your plan</h4>
                  </div>
                  <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th width="20%">Plan Name</th>
                            <th width="30%">Plan Features</th>
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
                              Dental Chart<br>
                              Inventory Management
                            </td>
                            <td>
                              <span class="pricing">&#8369;1,799 / Month</span><br>
                            </td>
                            <td>
                              @if($subscriptions->where('plan', 'basic')->first())
                                <button class="btn btn-success"><i class="fa fa-check"></i> Subscribed</button>
                              @else
                                <button data-plan="Basic" data-plan-amount="1799" data-plan-currency="&#8369" class="btn btn-primary subscribe">Subscribe</button>
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td>Premium Plan</td>
                            <td>
                              <span style="font-weight: bold;">All Basic Plan Features</span> <br>
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
    $(".subscribe").unbind().click(function() {
        var plan = $(this).data('plan');
        var currency = $(this).data('plan-currency');
        var planAmount = $(this).data('plan-amount');
        var frequency = 'monthly';

        Swal.fire({
            title: 'Confirming...',
            text: "You are about to subscribe to our " + plan + " Plan. By subscribing to this plan, You've agreed that you will be billed the amount of " + currency+ numberWithCommas(planAmount) + " monthly until you end your subscription. Do you wish to continue?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, subscribe now!'
        }).then((result) => {
            if (result.value) {
              $.ajax({
                method: "POST",
                url: "/subscription/subscribe",
                data: { 
                  plan: plan.toLowerCase(),
                  amount: planAmount,
                  frequency: frequency,
                  _token: "{{ csrf_token() }}" 
                }
              })
              .done(function( msg ) {
                Swal.fire(
                  'Subscribed!',
                  'You have successfully subscribe to ' + plan + " Plan.",
                  'success'
                ).then((result) => {
                  location.reload();
                });
              });
            }
        });
    });

    $("#cancel-subscription").click(function(){
        var id = $(this).data('subscription_id');
        var plan = $(this).data('plan');

        Swal.fire({
            title: 'Are you sure?',
            text: "You'll soon lose access to "+capitalizeFirstLetter(plan)+" Plan and will automatically downgrade your account into Free Plan by the end of your subscription. Do you wish to proceed?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
            if (result.value) {
              $.ajax({
                method: "POST",
                url: "/subscription/cancel_auto_renew",
                data: { 
                  id: id,
                  _token: "{{ csrf_token() }}" 
                }
              })
              .done(function( msg ) {
                Swal.fire(
                  'Canceled!',
                  'Auto-renew has been cancelled.',
                  'success'
                ).then((result) => {
                  location.reload();
                });
              });
            }
        });
    });

    $("#enable-auto-renew").click(function(){
        var id = $(this).data('subscription_id');
        var plan = $(this).data('plan');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action will enable auto-renew on your "+capitalizeFirstLetter(plan)+" plan. Do you wish to proceed?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Proceed!'
        }).then((result) => {
            if (result.value) {
              $.ajax({
                method: "POST",
                url: "/subscription/enable_auto_renew",
                data: { 
                  id: id,
                  _token: "{{ csrf_token() }}" 
                }
              })
              .done(function( msg ) {
                Swal.fire(
                  'Enabled!',
                  'Auto-renew has been enabled.',
                  'success'
                ).then((result) => {
                  location.reload();
                });
              });
            }
        });
        
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
});
</script>
@endsection
