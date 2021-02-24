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
</style>
@endsection

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
                  <div class="row col-md-3">
                  {{ Html::ul($errors->all()) }}

                  {{ Form::open(array('url' => 'patient', 'id' => 'form-add-patient')) }}
                      <div class="form-group">
                        {{ Form::label('first_name', 'First Name') }}
                        {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('last_name', 'Last Name') }}
                        {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                          {{ Form::label('dob', 'Date of birth') }}
                          {{ Form::text('dob', Input::old('dob'), array('class' => 'form-control', 'required', 'placeholder' => 'mm/dd/yyyy')) }}
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                          {{ Form::label('gender', 'Gender') }}
                          <select name="gender" class='form-control'>
                              <option value='' disabled>Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Other">Prefer not to say</option>
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
                        {{ Form::submit('Submit', array('class' => 'btn btn-round btn-primary')) }}
                      </div>
                  {{ Form::close() }}
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

  $('select[name=gender]').val(null);
});
</script>
@endsection
