@extends('layouts.app')

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">
  .ui-datepicker {
    background-color: #fff;
  }

  .ui-datepicker-header {
    background-color: #00cfd1;
  }

  .ui-datepicker-title {
    color: #636b6f;
  }

  .ui-widget-content .ui-state-default {
    border: 0px;
    text-align: center;
    background: #fff;
    font-weight: normal;
    color: #636b6f;
  }

  .ui-widget-content .ui-state-default:hover {
    border: 0px;
    text-align: center;
    background: #00cfd1;
    font-weight: normal;
    color: #fff;
  }

  .ui-widget-content .ui-state-active {
  border: 0px;
  background: #00cfd1;
  color: #fff;
  }

  .ui-datepicker-today {
    background: #00cfd1 !important;
  }

  .no-image {
    background-color: #ccc;
    padding-top:36px;
    margin-bottom: 5px;
  }

  .profile-picture {
    height: 170px;
    width: 170px;
  }

  .image-size {
    margin-top: 35px;
    margin-left:auto;
    margin-right: auto;
    width:70px;
    color: #666;
    font-family: sans-serif;
  }

  .remove-profile-pic {
    margin-bottom: 5px;
    width:170px;
    text-align: right;
  }

  #delete_patient_profile_picture {
    color: #ccc;
  }

  #delete_patient_profile_picture:hover {
    text-decoration: none;
    color: red;
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
                        {{ Form::model($patient, array('route' => array('patient.update', $patient->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}
                        {{ Html::ul($errors->all()) }}

                        <div class="form-group">
                          {{ Form::label('profile_pic', 'Profile Picture') }}

                          @if($patient->profile_picture == '')
                          <div class="profile-picture no-image">
                              <div class="image-size">170 x 170</div>
                          </div>

                          <input type="file" name="profile_picture">
                          @else
                          <div class="profile-picture">
                              @if(env('FILESYSTEM_DRIVER') == 'spaces')
                              <img class="profile-picture" src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/' . $patient->profile_picture) }}" />
                              @endif

                              @if(env('FILESYSTEM_DRIVER') == 'public')
                              <img class="profile-picture" src="{{ asset('storage/' . $patient->profile_picture) }}" />
                              @endif
                          </div>

                          <div class="remove-profile-pic">
                            <a id="delete_patient_profile_picture" href="/delete_patient_profile_pic/{{ $patient->id }}"><small>Remove</small></a>
                          </div>
                          @endif
                        </div>

                        <div class="form-group">
                          {{ Form::label('first_name', 'First Name') }}
                          {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('last_name', 'Last Name') }}
                          {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group row">
                          <div class="col-md-6">
                            {{ Form::label('dob', 'Date of birth') }}
                            {{ Form::text('dob', $patient->dob->format('m/d/Y'), array('class' => 'form-control', 'required', 'placeholder' => 'mm/dd/yyyy')) }}
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-md-6">
                            {{ Form::label('gender', 'Gender') }}
                            <select name="gender" class='form-control'>
                                <option value='' disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                          </div>
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

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#dob").datepicker({  
    maxDate: '0',
    format: 'mm/dd/yyyy',
    changeMonth: true,
    changeYear: true,
    // isRTL: true
  });

  $('select[name=gender]').val("{{ $patient->gender }}");
});
</script>
@endsection

