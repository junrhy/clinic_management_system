@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Settings <small class="text-muted">Manage web app domains</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>

                <div class="panel-body">
                    <div class="row col-md-3">
                          {{ Form::model($setting, array('route' => array('setting.update', $setting->id), 'method' => 'PUT')) }}
                            <div class="form-group">
                              {{ Form::label('name', 'Name') }}
                              {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                              {{ Form::label('value', 'Value') }}
                              {{ Form::text('value', Input::old('value'), array('class' => 'form-control')) }}
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