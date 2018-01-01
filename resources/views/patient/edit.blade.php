@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Patient</div>

                <div class="panel-body">
                  {{ Form::model($patient, array('route' => array('patient.update', $patient->id), 'method' => 'PUT')) }}
                  {{ Html::ul($errors->all()) }}

                  {{ Form::open(array('url' => 'patient')) }}
                    <h3 class="row col-md-12">Personal</h3>
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

                    <div class="form-group col-md-4">
                      {{ Form::label('name_of_father', 'Name of Father') }}
                      {{ Form::text('name_of_father', Input::old('name_of_father'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('name_of_mother', 'Name of Mother') }}
                      {{ Form::text('name_of_mother', Input::old('name_of_mother'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('mother_maiden_name', 'Mother\'s maiden name') }}
                      {{ Form::text('mother_maiden_name', Input::old('mother_maiden_name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-2">
                      {{ Form::label('age', 'Age') }}
                      {{ Form::text('age', Input::old('age'), array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group col-md-2">
                      {{ Form::label('gender', 'Gender') }}
                      {{ Form::select('gender', ['', 'Male', 'Female'], null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-2">
                      {{ Form::label('civil_status', 'Civil Status') }}
                      {{ Form::select('civil_status', ['', 'Single', 'Married', 'Widowed'], null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-1">
                      {{ Form::label('number_of_children', 'Children') }}
                      {{ Form::text('number_of_children', Input::old('number_of_children'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-3">
                      {{ Form::label('email', 'Email') }}
                      {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-2">
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
                      {{ Form::select('country', $countries, Input::old('country'), array('class' => 'form-control')) }}
                    </div>

                    <h3 class="row col-md-12">Work</h3>

                    <div class="form-group col-md-4">
                      {{ Form::label('occupation', 'Occupation') }}
                      {{ Form::text('occupation', Input::old('occupation'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('company_name', 'Company name') }}
                      {{ Form::text('company_name', Input::old('company_name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('company_email', 'Company Email') }}
                      {{ Form::email('company_email', Input::old('company_email'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-8">
                      {{ Form::label('company_address', 'Company Address') }}
                      {{ Form::text('company_address', Input::old('company_address'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('company_contact_number', 'Company Contact Number') }}
                      {{ Form::text('company_contact_number', Input::old('company_contact_number'), array('class' => 'form-control')) }}
                    </div>

                    <h3 class="row col-md-12">In case of Emergency</h3>

                    <div class="form-group col-md-4">
                      {{ Form::label('emergency_contact_name1', 'Emergency Contact Name 1') }}
                      {{ Form::text('emergency_contact_name1', Input::old('emergency_contact_name1'), array('class' => 'form-control')) }}
                      {{ Form::label('emergency_contact_number1', 'Emergency Contact Number 1') }}
                      {{ Form::text('emergency_contact_number1', Input::old('emergency_contact_number1'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('emergency_contact_name2', 'Emergency Contact Name 2') }}
                      {{ Form::text('emergency_contact_name2', Input::old('emergency_contact_name1'), array('class' => 'form-control')) }}
                      {{ Form::label('emergency_contact_number2', 'Emergency Contact Number 2') }}
                      {{ Form::text('emergency_contact_number2', Input::old('emergency_contact_number1'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group col-md-4">
                      {{ Form::label('emergency_contact_name3', 'Emergency Contact Name 3') }}
                      {{ Form::text('emergency_contact_name3', Input::old('emergency_contact_name1'), array('class' => 'form-control')) }}
                      {{ Form::label('emergency_contact_number3', 'Emergency Contact Number 3') }}
                      {{ Form::text('emergency_contact_number3', Input::old('emergency_contact_number1'), array('class' => 'form-control')) }}
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
