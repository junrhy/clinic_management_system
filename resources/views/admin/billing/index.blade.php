@extends('layouts.admin')

@section('page_level_css')
<style type="text/css">
  .latest_bill_status_published {
    color: green;
  }

  .latest_bill_status_on_hold {
    color: #c19302;
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
                                    <th>Subscriptions</th>
                                    <th>Latest Bill</th>
                                    
                                    <th>Bills Created</th>
                                    <th>Bills On Hold</th>
                                    <th>Bills Published</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>
                                        {{ $client->name }} (#{{ $client->account_number }})<br>
                                        <small style="color: #018d8e; font-family: 'arial';">Date Joined: {{ $client->created_at->format('M d, Y') }}</small><br>
                                        <small style="font-family: 'arial';">Account Type: {{ ucfirst($client->account_type) }}</small>
                                    </td>
                                    <td>
                                        @foreach($client->subscriptions as $subscription)
                                            <small style="color: #018d8e; font-family: 'arial';"><strong>{{ $subscription->plan }}</strong> {{ number_format($subscription->amount, 2) }} {{ $subscription->frequency }}</small><br>
                                        @endforeach
                                    </td>

                                    <td>
                                        <small style="font-family: 'arial';">
                                        @if($client->billing_statements->count() > 0)
                                            Total Amount Due: <strong style="color: #018d8e;">{{ number_format($client->billing_statements->where('is_latest', true)->first()->amount_due, 2) }}</strong> <br>
                                            Bill Date: <strong>{{ $client->billing_statements->where('is_latest', true)->first()->billed_at->format('M d, Y') }}</strong><br>
                                            Due Date: <strong>{{ $client->billing_statements->where('is_latest', true)->first()->due_at->format('M d, Y') }}</strong><br>
                                            Status: <strong class="latest_bill_status_{{ $client->billing_statements->where('is_latest', true)->first()->is_publish == true ? 'published' : 'on_hold' }}">
                                                {{ $client->billing_statements->where('is_latest', true)->first()->is_publish == true ? 'Published' : 'On Hold' }}</strong><br>
                                        @else
                                            Total Amount Due: 0 <br>
                                            Bill Date: N/A <br>
                                            Due Date: N/A <br>
                                            Status: N/A
                                        @endif
                                        </small>
                                    </td>

                                    @if($client->billing_statements->count() > 0)
                                        <td>{{ $client->billing_statements->count() }}</td>
                                        <td>{{ $client->billing_statements_unpublish->count() }}</td>
                                        <td>{{ $client->billing_statements_published->count() }}</td>
                                    @else
                                        <td>N/A</td>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                    @endif

                                    <td align="center">
                                        <a href="/admin/billing/view_estatements/{{ $client->id }}"><i class="fa fa-file-alt"></i> View Statements</a>
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