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
                    <div class="row col-md-3">
                          {{ Form::model($client, array('route' => array('admin.client.update', $client->id), 'method' => 'PUT')) }}
                            <div class="form-group">
                              {{ Form::label('app_license_no', 'App License Number') }}
                              {{ Form::text('app_license_no', Input::old('app_license_no'), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('is_active', 'Is Active?') }}
                              {{ Form::text('is_active', Input::old('is_active'), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('is_suspended', 'Is Suspended?') }}
                              {{ Form::text('is_suspended', Input::old('is_suspended'), array('class' => 'form-control')) }}
                            </div>
                            
                            {{ Form::submit('Save Changes', array('class' => 'btn btn-primary btn-round')) }}
                          {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection