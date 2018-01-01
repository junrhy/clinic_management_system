@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Therapist</div>

                <div class="panel-body">
                  {{ Form::model($therapist, array('route' => array('therapist.update', $therapist->id), 'method' => 'PUT')) }}
                    {{ Html::ul($errors->all()) }}

                    <div class="form-group col-md-4">
                      {{ Form::label('first_name', 'First Name') }}
                      {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('middle_name', 'Middle Name') }}
                      {{ Form::text('middle_name', Input::old('middle_name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('last_name', 'Last Name') }}
                      {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-2">
                      {{ Form::label('age', 'Age') }}
                      {{ Form::text('age', Input::old('age'), array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group col-md-2">
                      {{ Form::label('gender', 'Gender') }}
                      {{ Form::select('gender', ['' => '', 'Male' => 'Male', 'Female' => 'Female'], null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-2">
                      {{ Form::label('civil_status', 'Civil Status') }}
                      {{ Form::select('civil_status', ['' => '', 'Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed'], null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-3">
                      {{ Form::label('email', 'Email') }}
                      {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-3">
                      {{ Form::label('contact_number', 'Contact Number') }}
                      {{ Form::text('contact_number', Input::old('contact_number'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('address1', 'Address 1') }}
                      {{ Form::text('address1', Input::old('address1'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('address2', 'Address 2') }}
                      {{ Form::text('address2', Input::old('address2'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('town', 'Town') }}
                      {{ Form::text('town', Input::old('town'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('province', 'Province') }}
                      {{ Form::text('province', Input::old('province'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('country', 'Country') }}
                      {{ Form::select('country', $countries, null, array('class' => 'form-control')) }}
                    </div>

                    <div class="col-md-12">
                      {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
