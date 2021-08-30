@extends('layouts.app')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<style type="text/css">
    table {
        font-family: sans-serif;
    }

    .bg-green {
        background-color: #58D68D;
    }

    .bg-red {
        background-color: #ff5e5e;
    }

    .bg-orange {
        background-color: #F5B041;
    }

    #patient-name {
        font-weight: bold;
        color: #3498DB;
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
                        <h2>Patient Balance <small class="text-muted">Patient balance report</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active">Patient Balance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-file-alt" aria-hidden="true"></i> Patient balance view for <span id="patient-name">{{ $patient->first_name }} {{ $patient->last_name }}</span></div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Balance</h4>
                            <table class="table">
                                <tr>
                                    <td colspan="2" style="border:0;"><h4>Total Charges</h4></td>
                                    <td align="right" style="border:0;"><h4>{{ number_format($invoices->sum('amount'), 2) }}</h4></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border:0;"><h4>Total Payments</h4></td>
                                    <td align="right" style="border:0;"><h4>{{ number_format($payments->sum('amount'), 2) }}</h4></td>
                                </tr>
                                <tr class="bg-orange" style="border:0;">
                                    <td colspan="2" style="border:0;"><h4 style="color: #ffffff;">Remaining Balance</h4></td>
                                    <td align="right" style="border:0;"><h4 style="color: #ffffff;">{{ number_format($invoices->sum('amount') - $payments->sum('amount'), 2) }}</h4></td>
                                </tr>
                            </table>
                            <br>

                            <h4>Charges</h4>
                            <table class="table">
                                <thead>
                                    <th width="20%">Date</th>
                                    <th>Description</th>
                                    <th style="text-align:right;">Amount</th>
                                </thead>
                                <tbody>
                                    @foreach($invoices as $key => $invoice)
                                    <tr>
                                        <td>{{ $invoice->created_at->format('m-d-Y') }}</td>
                                        <td>{{ str_limit($invoice->description, 50) }}</td>
                                        <td align="right">{{ number_format($invoice->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tfoot>
                                        <tr class="bg-red">
                                            <td colspan="2"><h4 style="color: #ffffff;">Total Charges</h4></td>
                                            <td align="right"><h4 style="color: #ffffff;">{{ number_format($invoices->sum('amount'), 2) }}</h4></td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                            <br>
                            <h4>Payments</h4>
                            <table class="table">
                                <thead>
                                    <th width="20%">Date</th>
                                    <th>Description</th>
                                    <th style="text-align:right;">Amount</th>
                                </thead>
                                <tbody>
                                    @foreach($payments as $key => $payment)
                                    <tr>
                                        <td>{{ $payment->created_at->format('m-d-Y') }}</td>
                                        <td>{{ str_limit($payment->description, 50) }}</td>
                                        <td align="right">{{ number_format($payment->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tfoot>
                                        <tr class="bg-green">
                                            <td colspan="2"><h4 style="color: #ffffff;">Total Payments</h4></td>
                                            <td align="right"><h4 style="color: #ffffff;">{{ number_format($payments->sum('amount'), 2) }}</h4></td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-8">
                            
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
