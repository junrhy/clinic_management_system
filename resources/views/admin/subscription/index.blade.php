@extends('layouts.admin')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
    .subscription-row {
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                <tr class="subscription-row">
                                    <td>{{ $subscription->client->name }} ( #{{ $subscription->client->account_number }} )</td>
                                    <td>{{ $subscription->plan }}</td>
                                    <td>{{ number_format($subscription->amount, 2) }}</td>
                                    <td>{{ $subscription->frequency }}</td>
                                    <td>{{ $subscription->start->format('M d, Y h:iA') }}</td>
                                    <td>{{ $subscription->end->format('M d, Y h:iA') }}</td>
                                    <td>{{ \Carbon\Carbon::now()->diffInDays($subscription->end, false) }} Days</td>
                                    <td>
                                        <a href="/admin/subscription/renew/{{ $subscription->id }}">Renew</a>
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

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {

    
});
</script>
@endsection