@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Billings <small class="text-muted">Manage web app billings</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Billings</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Billings</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Outstanding Balance</th>
                                    <th>Billed Date</th>
                                    <th>Due Date</th>
                                    <th>Final Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($billings as $billing)
                                <tr>
                                    <td>{{ $billing->client->name }} ({{ $payment->client->account_number }})</td>
                                    <td>{{ $billing->outstanding_balance }}</td>
                                    <td>{{ $billing->billed_at }}</td>
                                    <td>{{ $billing->due_at }}</td>
                                    <td>{{ $billing->final_due_at }}</td>
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