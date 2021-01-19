@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Edit Doctor <small class="text-muted">Welcome to {{ Auth::user()->client->name }}</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Doctor</li>
                            <li class="breadcrumb-item active">Edit Doctor</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Edit Doctor</div>

                <div class="panel-body">
                    <div class="row col-md-3">
                        {{ Form::model($doctor, array('route' => array('doctor.update', $doctor->id), 'method' => 'PUT')) }}
                        {{ Html::ul($errors->all()) }}

                        <div class="form-group">
                          {{ Form::label('first_name', 'First Name') }}
                          {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('last_name', 'Last Name') }}
                          {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'required')) }}
                        </div>

                        <div>
                          {{ Form::submit('Save Changes', array('class' => 'btn btn-primary btn-round')) }}
                        </div>
                      {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
