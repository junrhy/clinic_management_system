@extends('layouts.admin')

@section('page_level_css')
<style type="text/css">
    .date {
        font-size: 10pt;
        font-family: sans-serif;
        color: #018d8e;
    }

    .diff {
        color: red;
    }

    h3 {
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
                        <h2>Users <small class="text-muted">Manage web app users</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <a class="btn btn-white btn-icon btn-round float-right m-l-10" href="{{ url('/admin/setting/create') }}" type="button">
                            <i class="fa fa-plus"></i>
                        </a>

                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">List of Users</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 style="color: #018d8e;">Total Users: {{ $users->count() }}</h3>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="table-responsive col-md-3">
                            <h3>Admins: {{ $users->where('type', 'admin')->count() }}</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Last Logged In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users->where('type', 'admin') as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td class="date">
                                            {{ $user->last_active_at->format('M-d-Y, h:iA') }}<br>
                                            <span class="diff">{{ $user->last_active_at->diffForHumans() }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive col-md-4">
                            <h3>Clients & Staffs: {{ $users->where('type', 'default')->count() }}</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Last Logged In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users->where('type', 'default') as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td class="date">
                                            {{ $user->last_active_at->format('M-d-Y, h:iA') }}<br>
                                            <span class="diff">{{ $user->last_active_at->diffForHumans() }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive col-md-5">
                            <h3>Patients: {{ $users->where('type', 'patient')->count() }}</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Client</th>
                                        <th>Last Logged In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users->where('type', 'patient') as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->client->name }}</td>
                                        <td class="date">
                                            {{ $user->last_active_at->format('M-d-Y, h:iA') }}<br>
                                            <span class="diff">{{ $user->last_active_at->diffForHumans() }}</span>
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
</div>
@endsection