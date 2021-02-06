@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Subscriptions <small class="text-muted">Manage web app subscriptions</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Subscriptions</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Subscriptions</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Frequency</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                <tr>
                                    <td>{{ $subscription->client->name }} ( #{{ $subscription->client->account_number }} )</td>
                                    <td>{{ $subscription->plan }}</td>
                                    <td>{{ $subscription->amount }}</td>
                                    <td>{{ $subscription->frequency }}</td>
                                    <td>{{ $subscription->start->format('M d, Y') }}</td>
                                    <td>{{ $subscription->end->format('M d, Y') }}</td>
                                    <td>{{ $subscription->end->diffInDays($subscription->start) }} Days</td>
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