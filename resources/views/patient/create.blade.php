@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Add Patient <small class="text-muted">Welcome to {{ Auth::user()->client->name }}</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Patient</li>
                            <li class="breadcrumb-item active">Add Patient</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Add Patient</div>

                <div class="panel-body">
                  {{ Html::ul($errors->all()) }}

                  {{ Form::open(array('url' => 'patient', 'id' => 'form-add-patient')) }}
                    <h3 class="row col-md-12">Personal</h3>
                    <div class="form-group col-md-12">
                      {{ Form::label('first_name', 'First Name') }}
                      {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group col-md-12">
                      {{ Form::label('last_name', 'Last Name') }}
                      {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group col-md-12">
                      {{ Form::label('dob', 'Date of birth') }}
                      {{ Form::text('dob', Input::old('dob'), array('class' => 'form-control', 'required', 'placeholder' => 'mm/dd/yyyy')) }}
                    </div>

                    <div class="form-group col-md-12">
                      {{ Form::label('gender', 'Gender') }}
                      {{ Form::select('gender', ['' => '', 'Male' => 'Male', 'Female' => 'Female'], null, array('class' => 'form-control')) }}
                    </div>
        
                     <div class="form-group col-md-12">
                      {{ Form::label('email', 'Email') }}
                      {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-12">
                      {{ Form::label('contact_number', 'Contact Number') }}
                      {{ Form::text('contact_number', Input::old('contact_number'), array('class' => 'form-control')) }}
                    </div>

                    <div class="col-md-4">
                      {{ Form::submit('Submit', array('class' => 'btn btn-round btn-primary')) }}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
