@extends('layouts.patient')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<style type="text/css">

</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-md-12">
        	<br><br>
        	<div class="panel panel-primary">
        
                <div class="panel-heading">Request new appointment</div>

                <div class="panel-body">
                	
                	<div class="row col-md-4">
	                      @if (count($errors) > 0)
	                         <span style="color:red">
	                            {{ Html::ul($errors->all()) }}
	                         </span>
	                      @endif

	                      @if ($message = Session::get('success'))
	                        <div class="alert alert-success alert-block">
	                            <button type="button" class="close" data-dismiss="alert">×</button> 
	                            <strong>{{ $message }}</strong>
	                        </div>
	                      @endif

	                      {{ Form::open(array('url' => '/patient_view/submit_appointment_request')) }}
	                       
	                        <div class="form-group">
	                          {{ Form::label('date_scheduled', 'Date') }}
	                          {{ Form::text('date_scheduled', null, array('class' => 'form-control', 'required', 'autocomplete' => 'off')) }}
	                        </div>

	                        <div class="form-group">
	                          {{ Form::label('time_scheduled', 'Time') }}
	                          {{ Form::text('time_scheduled', null, array('class' => 'form-control', 'required', 'autocomplete' => 'off')) }}
	                        </div>

	                        <div class="form-group">
	                          {{ Form::label('clinic_id', 'Clinic') }}
	                          <select name="clinic_id" class="form-control">
	                          		@foreach($clinics as $clinic)
	                          		<option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
	                          		@endforeach
	                          </select>
	                        </div>

	                        <div class="form-group">
	                          {{ Form::label('doctor_id', 'Doctor') }}
	                          <select name="doctor_id" class="form-control">
	                          		@foreach($doctors as $doctor)
	                          		<option value="{{ $doctor->id }}">{{ $doctor->fullname }}</option>
	                          		@endforeach
	                          </select>
	                        </div>

	                        <div class="form-group">
	                          {{ Form::label('service', 'Purpose') }}
	                          <select name="service" class="form-control">
	                          		@foreach($services as $service)
	                          		<option value="{{ $service->name }}">{{ $service->name }}</option>
	                          		@endforeach
	                          </select>
	                        </div>

	                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

	                        <div style="padding-top:6px;display: inline-block;"><a href="/patient_view">Back</a></div>

	                        {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-round pull-right')) }}
	                       {{ Form::close() }}  
	                </div>
     
                </div>
        
            </div>

        	
        </div>

    </div>
</div>

	

@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#date_scheduled').datepicker({
		minDate: 0
	});
	$('#time_scheduled').timepicker({});
});
</script>
@endsection