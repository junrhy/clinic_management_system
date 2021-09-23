@extends('layouts.admin')

@section('page_level_css')
<style type="text/css">
    .m-t-0 {
        margin-top: 0px;
    }

    .m-b-5 {
        margin-bottom: 5px;
    }

    .card {
        width:13em;
        text-align: center;
        padding:2em;
        border-radius: 5px;
        border: 2px solid #ffffff;
    }

    .clinic-appointments {
        border: 2px solid #ffffff;
    }

    .card-color-1 {
        background-color: #fec4d2;
    }

    .card-color-2 {
        background-color: #c4effe;
    }

    .card-color-3 {
        background-color: #c4fed3;
    }

    .text-color-1 {
        color: #fec4d2;
    }

    .text-color-2 {
        color: #2ec7fc;
    }

    .text-color-3 {
        color: #c4fed3;
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
                        <h2>Dashboard <small class="text-muted">Overview of web app performance</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <h3 class="row col-md-12">Overview</h3>
                    <div class="row col-md-12">
                        <div class="card card-color-2 col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $clients->count() }}</h2>
                            <p class="text-muted">Clients</p>
                        </div>

                        <div class="card card-color-3 col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $users->count() }}</h2>
                            <p class="text-muted">Users</p>
                        </div>

                        <div class="card card-color-2 col-md-2">
                            <h2 class="number count-to m-t-0 m-b-5" data-from="0" data-to="501" data-speed="1000" data-fresh-interval="700">{{ $unread_message_count }}</h2>
                            <p class="text-muted">Messages</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection