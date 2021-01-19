@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Change patient details <small class="text-muted">Welcome to {{ Auth::user()->client->name }}</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Patient</li>
                            <li class="breadcrumb-item active">Change patient details</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Change patient details</div>

                <div class="panel-body">
                    <div class="row col-md-3">
                        {{ Form::model($patient, array('route' => array('patient.update', $patient->id), 'method' => 'PUT')) }}
                        {{ Html::ul($errors->all()) }}

                        <div class="form-group">
                          {{ Form::label('first_name', 'First Name') }}
                          {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('last_name', 'Last Name') }}
                          {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('dob', 'Date of birth') }}
                          {{ Form::text('dob', $patient->dob->format('m/d/Y'), array('class' => 'form-control', 'placeholder' => 'mm/dd/yyyy')) }}
                        </div>
                        
                        <div class="form-group">
                          {{ Form::label('gender', 'Gender') }}
                          {{ Form::select('gender', ['' => '', 'Male' => 'Male', 'Female' => 'Female'], null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('email', 'Email') }}
                          {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('contact_number', 'Contact Number') }}
                          {{ Form::text('contact_number', Input::old('contact_number'), array('class' => 'form-control')) }}
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
