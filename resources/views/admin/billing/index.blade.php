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
                <div class="panel-heading">Latest Billing Statements</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Account Type</th>
                                    <th>Subscriptions</th>
                                    <th>Outstanding Balance</th>
                                    <th>Latest Bill Date</th>
                                    <th>Latest Due Date</th>
                                    <th>Latest Final Due Date</th>
                                    <th>Is Latest Bill Published?</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>
                                        {{ $client->name }} (#{{ $client->account_number }})<br>
                                        <small style="color: #018d8e; font-family: 'arial';">Date Joined: {{ $client->created_at->format('M d, Y') }}</small><br>
                                    </td>
                                    <td>{{ ucfirst($client->account_type) }}</td>
                                    <td>
                                        @foreach($client->subscriptions as $subscription)
                                            <small style="color: #018d8e; font-family: 'arial';"><strong>{{ $subscription->plan }}</strong> {{ number_format($subscription->amount, 2) }} {{ $subscription->frequency }}</small><br>
                                        @endforeach
                                    </td>

                                    @if($client->billing_statements->count() > 0)
                                        <td>{{ $client->billing_statements->where('is_latest', true)->first()->outstanding_balance }}</td>
                                        <td>{{ $client->billing_statements->where('is_latest', true)->first()->billed_at }}</td>
                                        <td>{{ $client->billing_statements->where('is_latest', true)->first()->due_at }}</td>
                                        <td>{{ $client->billing_statements->where('is_latest', true)->first()->final_due_at }}</td>
                                        <td>{{ $client->billing_statements->where('is_latest', true)->first()->is_publish }}</td>
                                    @else
                                        <td>0</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    @endif
                                    <td>
                                        <a href="/admin/billing/view_estatements/{{ $client->id }}"><i class="fa fa-file"></i> View eStatements</a>
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