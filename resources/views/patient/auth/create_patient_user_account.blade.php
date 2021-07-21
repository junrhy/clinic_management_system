@extends('layouts.app')

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<style type="text/css">

</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Create Patient Login Account <small class="text-muted">You can give login access to your patient so that they can request appointment through the system.</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item"><a href="/patient">Patient List</a></li>
                            <li class="breadcrumb-item active">Create Login Account</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Create login account</div>

                <div class="panel-body">
                  <div class="row col-md-3">
                    @if (count($errors) > 0)
                        <span style="color:red">
                            {{ Html::ul($errors->all()) }}
                        </span>
                    @endif

                  {{ Form::open(array('url' => '/patient/save_patient_user_account', 'enctype' => 'multipart/form-data')) }}
                        <div class="form-group">
                          {{ Form::label('patient_name', 'Patient Name') }}
                          {{ Form::text('patient_name', $patient->first_name . " " . $patient->last_name, array('class' => 'form-control', 'disabled')) }}
                        </div>

                        {{ Form::hidden('patient_id', $patient->id, array('class' => 'form-control')) }}

                        <div class="form-group">
                          {{ Form::label('username', 'Username') }}
                          {{ Form::text('username', null, array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('password', 'Password') }}
                          {{ Form::password('password', array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('password_confirmation', 'Confirm Password') }}
                          {{ Form::password('password_confirmation', array('class' => 'form-control', 'required')) }}
                        </div>

                        <div>
                          {{ Form::submit('Create Account', array('class' => 'btn btn-round btn-primary')) }}
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

});
</script>
@endsection
