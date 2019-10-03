@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Patient</div>

                <div class="panel-body">
                  {{ Form::model($patient, array('route' => array('patient.update', $patient->id), 'method' => 'PUT')) }}
                  {{ Html::ul($errors->all()) }}

                    <h3 class="row col-md-12">Personal</h3>
                    <div class="form-group col-md-12">
                      {{ Form::label('first_name', 'First Name') }}
                      {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group col-md-12">
                      {{ Form::label('last_name', 'Last Name') }}
                      {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-12">
                      {{ Form::label('dob', 'Date of birth') }}
                      {{ Form::text('dob', $patient->dob->format('m/d/Y'), array('class' => 'form-control', 'placeholder' => 'mm/dd/yyyy')) }}
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

                    <div class="col-md-12">
                      {{ Form::submit('Save Changes', array('class' => 'btn btn-primary btn-round')) }}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
