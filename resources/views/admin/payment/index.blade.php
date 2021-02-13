@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Payments <small class="text-muted">Manage web app payments</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Payments</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Payments</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Total Paid</th>
                                    <th>Last Payment Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr style="font-family: sans-serif;">
                                    <td>{{ $client->name }} ({{ $client->account_number }})</td>
                                    <td>{{ $app_currency }} {{ number_format($client->payments != null ? $client->payments->sum('amount') : 0, 2) }}</td>
                                    <td>
                                        @if(count($client->payments) > 0)
                                        <?php $last_payment = $client->payments->first(); ?>

                                        {{ $last_payment->created_at->format('M d, Y') }}    

                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/payments/view_payments/{{ $client->id }}"><i class="fa fa-file-alt"></i> View Payments</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection