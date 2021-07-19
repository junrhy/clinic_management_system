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

    input[type=text], input[type=number] {
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

    .make-primary {
        cursor: pointer;
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

    .d-none {
        display: none;
    }

    #add-card {
        cursor: pointer;
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
                                        <div class="col-md-12">
                                            <a id="add-card">Add Card</a>
                                            <br><br>
                                            <div class="row">
                                                <div id="new_card" class="col-md-4 d-none">
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
                                                    <input type="number" id="ccnum" name="cardnumber" placeholder="1111222233334444" maxlength="16">
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
                                                            <input type="number" id="expyear" name="expyear" placeholder="2018">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="cvv">CVV</label>
                                                            <input type="number" id="cvv" name="cvv" placeholder="352">
                                                        </div>
                                                    </div>

                                                    <input type="submit" value="Add Card" id="submit-card" class="btn btn-primary btn-block">
                                                </div>
                                            </div>

                                            <div class="row table-responsive">
                                                <div id="card-list" class="col-md-6">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th>Name on Card</th>
                                                            <th>Credit / Debit card number</th>
                                                            <th></th>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($client_cards as $card_key => $card_item): ?>
                                                            <tr>
                                                                <td>{{ $card_item->name_on_card }}</td>
                                                                <td>{{ $card_item->card_number }}</td>
                                                                <td align="right">
                                                                    @if($card_item->is_default)
                                                                        <span style="color:#ccc;">This is your primary card</span>
                                                                    @else
                                                                        <a class="make-primary" data-id="{{  $card_item->id }}">Make Primary</a>
                                                                        |
                                                                        <a class="remove-card" data-id="{{  $card_item->id }}">Remove</a>
                                                                    @endif    
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; ?>

                                                            @if($client_cards->count() == 0)
                                                            <tr>
                                                                <td align="center" colspan="3">No card found.</td>
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
                                                    <li>To: <strong>jrcrodua@gmail.com</strong></li>
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
                                                        <li>To: <strong>jrcrodua@gmail.com</strong></li>
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
                                                        <li>To: <strong>jrcrodua@gmail.com</strong></li>
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
    $("#add-card").click(function(){
        $("#new_card").toggleClass('d-none');
        $("#card-list").toggleClass('d-none');

        if ( $(this).html() == 'Add Card' ) {
            $(this).html('Cancel');
        } else {
            $(this).html('Add Card');
        }
        
    });

    $("#submit-card").click(function(){
        var cname = $("#cname").val();
        var ccnum = $("#ccnum").val();
        var expmonth = $("#expmonth").val();
        var expyear = $("#expyear").val();
        var cvv = $("#cvv").val();

        $.ajax({
            method: "POST",
            url: "/payment_method/save_card",
            data: { 
                cname: cname,
                ccnum: ccnum,
                expmonth: expmonth,
                expyear: expyear,
                cvv: cvv,
                _token: "{{ csrf_token() }}" 
            }
        })
        .done(function( data ) {
            window.location.reload();
        });
    });
    
    $(".remove-card").unbind().click(function(){
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: "/payment_method/remove_card",
                    data: { 
                        id: id,
                        _token: "{{ csrf_token() }}" 
                    }
                })
                .done(function( data ) {
                    window.location.reload();
                });
            }
        });
    });

    $(".make-primary").unbind().click(function(){
        var id = $(this).data('id');

        $.ajax({
            method: "POST",
            url: "/payment_method/make_primary",
            data: { 
                id: id,
                _token: "{{ csrf_token() }}" 
            }
        })
        .done(function( data ) {
            window.location.reload();
        });
    });
});
</script>
@endsection
