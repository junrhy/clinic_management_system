@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Clients <small class="text-muted">Manage web app clients</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Clients</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Clients</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Email2</th>
                                    <th>Contact</th>
                                    <th>Account No.</th>
                                    <th>Account Type</th>
                                    <th>License No.</th>
                                    <th>Is Active?</th>
                                    <th>Is Suspended?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->user->username }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->secondary_email }}</td>
                                    <td>{{ $client->contact }}</td>
                                    <td>{{ $client->account_number }}</td>
                                    <td>{{ $client->account_type }}</td>
                                    <td>{{ $client->app_license_no }}</td>
                                    <td>{{ $client->is_active }}</td>
                                    <td>{{ $client->is_suspended }}</td>
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