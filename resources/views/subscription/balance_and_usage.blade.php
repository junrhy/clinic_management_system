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

  .balance_value {
    font-size: 14pt;
    font-family: sans-serif;
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
                        <h2>Balance<small class="text-muted">View your account balance.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active">Balance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Balance</div>

                <div class="panel-body">
                  <div class="row">
                     <div class="col-md-5">
                      <h4 style="border-bottom:2px dotted #00cfd1;padding:10px;color:#00cfd1;font-weight: bold;"><i class="fa fa-file"></i> Balance</h4>
                    </div>
                  </div>

                  <div class="row">
                      <div class="table-responsive col-md-5">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Account Number</th>
                                <th><span class="balance_value">{{ auth()->user()->client->account_number }}</span></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Bill Period</td>
                                <td><span class="balance_value">{{ $bill_period }}</span></td>
                              </tr>
                              <tr>
                                <td>Previous bill balance</td>
                                <td><span class="balance_value">{{ number_format($prev_bill_balance, 2) }}</span></td>
                              </tr>
                              <tr>
                                <td>Current bill charges</td>
                                <td><span class="balance_value">{{ number_format($current_bill_charges, 2) }}</span></td>
                              </tr>
                              <tr>
                                <td>Adjustments</td>
                                <td><span class="balance_value">{{ number_format($adjustments, 2) }}</span></td>
                              </tr>
                              <tr>
                                <td>Total amount due</td>
                                <td><span class="balance_value">{{ number_format($total_amount_due, 2) }}</span></td>
                              </tr>
                              <tr>
                                <td>Payment due date</td>
                                <td><span class="balance_value">{{ $payment_due_date }}</span></td>
                              </tr>
                              <tr>
                                <td align="center">
                                  <a href="{{ url('view_estatements') }}" class="btn btn-primary">View Statements</a>
                                </td>
                                <td align="center">
                                  <a href="{{ url('pay_bills') }}" class="btn btn-primary">Pay bills now</a>
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
</div>
@endsection
@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  
});
</script>
@endsection
