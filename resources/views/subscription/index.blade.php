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

  .btn-success {
    border: 2px solid green;
    background-color: transparent;
    font-weight: bold;
    color: green;
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
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Subscription</strong></li>
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
                  <small style="color: green;">This services is active during this period and will be automatically renewed every time the bill is paid.</small>
                  <div class="table-responsive row">
                    <div class="col-md-5">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Plan</th>
                            <th>Active from</th>
                            <th>Until</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        @foreach($subscriptions as $subscription)
                        <tr>
                          <td>{{ ucfirst($subscription->plan) }} Plan</td>
                          <td>{{ $subscription->start->format('M d, Y') }}</td>
                          <td>{{ $subscription->end->format('M d, Y') }}</td>
                          <td>
                            @if(\Carbon\Carbon::now()->diffInDays($subscription->end, false) > 0)
                              Will expire in {{ \Carbon\Carbon::now()->diffInDays($subscription->end, false) }} days from now
                            @else
                              This subscription is expired. <a href="/balance_and_usage">Renew Now</a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                  </div>

                   <div class="row">
                    <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-gear"></i> Upgrade your plan</h4>
                  </div>
                  <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th width="20%">Plan Name</th>
                            <th width="30%">Plan Features</th>
                            <th>Pricing 
                              <select id="frequency">
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                              </select>
                            </th>
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
                              @if(request()->frequency == 'yearly')
                              <span class="pricing"><span style="text-decoration: line-through;">&#8369;21,600 / year</span> &#8369;18,899 / year</span><br>
                              <small style="color: red;">12% discount</small>
                              @else
                              <span class="pricing">&#8369;1,799 / month</span><br>
                              <small>Pay yearly to enjoy huge discount</small>
                              @endif
                            </td>
                            <td>
                              @if(Auth::user()->client->account_type == "basic")
                                <button class="btn btn-success"><i class="fa fa-check"></i> Subscribed</button>
                              @else
                                @if(request()->frequency == 'yearly')
                                <button data-plan="Basic" data-plan-amount="18899" data-plan-currency="&#8369" class="btn btn-primary subscribe">Subscribe</button>
                                @else
                                <button data-plan="Basic" data-plan-amount="1799" data-plan-currency="&#8369" class="btn btn-primary subscribe">Subscribe</button>
                                @endif
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
        var frequency = $("#frequency").val();

        Swal.fire({
            title: 'Confirming...',
            text: "You are about to subscribe to our " + plan + " Plan. By subscribing to this plan, You agreed that you will be billed the amount of " + currency+planAmount + " "+ frequency + " until you end your subscription. Do you wish to continue?",
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

    $("#frequency").change(function(){
      var frequency = $(this).val();
      location.href="?frequency="+frequency;
    });

    $("#frequency").val("{{ isset($_GET['frequency']) ? $_GET['frequency'] : 'monthly' }}");
   
});
</script>
@endsection
