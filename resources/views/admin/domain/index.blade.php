@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Domains <small class="text-muted">Manage web app domains</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Domains</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Domains</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Domain Name</th>
                                    <th>Client Name</th>
                                    <th>Parameters</th>
                                    <th>Distributor Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($domains as $domain)
                                <tr>
                                    <td>{{ $domain->domain_name }}</td>
                                    <td>{{ $domain->client_id != 0 ? $domain->client->name : 'default' }}</td>
                                    <td>{{ $domain->params }}</td>
                                    <td>{{ $domain->distributor_code }}</td>
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