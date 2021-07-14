@extends('layouts.app')

@section('page_level_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endsection

@section('page_level_css')
<style type="text/css">
    .nav-tabs {
        border-bottom: 1px solid #01d8da;
    }

    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        border-radius: 0px;
        border-color: #01d8da;
        background-color: #01d8da;
        color: #ffffff;
        font-weight: bold;
    }

    input[type=text] {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    select {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    label {
      margin-bottom: 10px;
      display: block;
    }

    .icon-container {
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }

    .remove-card {
        color: red;
        cursor: pointer;
    }

    .remove-card:hover {
        color: red;
        cursor: pointer;
    }

    .logo {
        height: 60px;
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
                        <h2>Payment Method<small class="text-muted">How do you want to pay for your subscription.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">Payment Method</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Choose Payment Method</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <ul class="nav nav-tabs">
                                <li class="nav-item active">
                                    <a data-toggle="tab" id="card_tab" href="#card">Credit / Debit Card</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" id="gcash_tab" href="#gcash">Gcash</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" id="bank_tab" href="#bank">Bank Transfer</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="tab-content">
                                <div id="card" class="tab-pane fade in active">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span>Select the card you want to use for your subscription.</span><br><br>
                                            <a href="">New Card</a>
                                            <br><br>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <th>Name on Card</th>
                                                        <th>Credit / Debit card number</th>
                                                        <th></th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>card name</td>
                                                            <td>card number</td>
                                                            <td align="right">
                                                                <a class="">Select</a>
                                                                |
                                                                <a class="remove-card">Remove</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-offset-1 col-lg-4">
                                            <label for="fname">Accepted Cards</label>
                                            <div class="icon-container">
                                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                                            </div>
                                           
                                            <label for="cname">Name on Card</label>
                                            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                            <label for="ccnum">Credit / Debit card number</label>
                                            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                                            <label for="expmonth">Exp Month</label>
                                            <select id="expmonth" name="expmonth">
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="expyear">Exp Year</label>
                                                    <input type="text" id="expyear" name="expyear" placeholder="2018">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cvv">CVV</label>
                                                    <input type="text" id="cvv" name="cvv" placeholder="352">
                                                </div>
                                            </div>

                                            <input type="submit" value="Add Card" class="btn btn-primary btn-block">
                                        </div>
                                    </div>
                                </div>

                                <div id="gcash" class="tab-pane fade in">
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;&nbsp;&nbsp;
                                            <img src="/img/payment-gateway/gcash.png" class="logo"> 
                                            Steps on how to pay your subscription via GCash.
                                            <br><br>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="col-md-12">Pay via GCash</h4>
                                        </div>
                                        <ol>
                                            <li>From the GCash dashboard, tap “Send Money.”</li>
                                            <li>Tap “Express Send.”</li>
                                            <li>Enter the GCash mobile number: <strong style="font-family: sans-serif;">09260049848</strong></li>
                                            <li>Enter the amount to send.</li>
                                            <li>Wait for the text confirmation of your transaction.</li>
                                            <li>Take a picture of the payment receipt or the text confirmation and email it
                                                <ul>
                                                    <li>To: <strong>billing@bluewhalecms.com</strong></li>
                                                    <li>Subject: <strong>"Payment for {{ Auth::user()->client->name }} ( Acct #: <span style="font-family: sans-serif;">{{ Auth::user()->client->account_number }}</span> )"</strong></li>
                                                </ul>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                
                                <div id="bank" class="tab-pane fade in">
                                    <div class="row">
                                        <div class="col-md-12">
                                            &nbsp;&nbsp;&nbsp;
                                            <img src="/img/payment-gateway/bdo.png" class="logo"></img>
                                            Steps on how to pay your subscription via Bank Transfer.
                                            <br><br>
                                        </div>
                                        
                                        <div class="col-md-5" style="border-right: 1px dashed #000;">
                                            <h4 class="col-md-12">Online Banking</h4>
                                            <ol>
                                                <li>Visit your bank website or open your bank mobile app.</li>
                                                <li>Log in to your account.</li>
                                                <li>Send money to the following details: 
                                                    <ul>
                                                        <li>Bank Name: BDO Unibank Inc. </li>
                                                        <li>Type of Account: Savings </li>
                                                        <li>Account Number: <strong style="font-family: sans-serif;">002510248371</strong></li>
                                                        <li>Account Name: Jun Rhy Crodua</li>
                                                    </ul>
                                                </li>
                                                <li>Review the details.</li>
                                                <li>Take note of the Reference Number.</li>
                                                <li>Take a picture of the confirmation and email it
                                                    <ul>
                                                        <li>To: <strong>billing@bluewhalecms.com</strong></li>
                                                        <li>Subject: <strong>"Payment for {{ Auth::user()->client->name }} ( Acct #: <span style="font-family: sans-serif;">{{ Auth::user()->client->account_number }}</span> )"</strong></li>
                                                    </ul>
                                                </li>
                                            </ol>
                                        </div>

                                        <div class="col-md-7">
                                            <h4 class="col-md-12">Over the Counter Deposit Payment at any BDO branch</h4>
                                            <ol>
                                                <li>Get a copy of BDO Deposit Slip.</li>
                                                <li>Fill-out the necessary details: 
                                                    <ul>
                                                        <li>Type of Account: Savings </li>
                                                        <li>Account Number: <strong style="font-family: sans-serif;">002510248371</strong></li>
                                                        <li>Account Name: Jun Rhy Crodua</li>
                                                    </ul>
                                                </li>
                                                <li>Give the deposit slip to the teller.</li>
                                                <li>Take a picture of the deposit slip copy and email it
                                                    <ul>
                                                        <li>To: <strong>billing@bluewhalecms.com</strong></li>
                                                        <li>Subject: <strong>"Payment for {{ Auth::user()->client->name }} ( Acct #: <span style="font-family: sans-serif;">{{ Auth::user()->client->account_number }}</span> )"</strong></li>
                                                    </ul>
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
