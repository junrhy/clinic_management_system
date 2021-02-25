@extends('layouts.patient')

@section('page_level_script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
@endsection

@section('page_level_css')

<style type="text/css">
  .show_link, .print-link {
    font-size: 9pt;
    color: #008385;
    cursor: pointer;
  }

  .nodisplay {
    display: none;
  }
</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        
        <div class="col-md-12">
        	<br><br>
        	<div class="panel panel-primary">
        
                <div class="panel-heading">Change Password</div>

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

	                      {{ Form::open(array('url' => '/patient_view/update_password')) }}
	                        {{ Form::hidden('username', $username, array('class' => 'form-control', 'readonly')) }}

	                        <div class="form-group">
	                          {{ Form::label('password', 'Current Password') }}
	                          {{ Form::password('password', array('class' => 'form-control', 'required')) }}
	                        </div>

	                        <div class="form-group">
	                          {{ Form::label('new_password', 'New Password') }}
	                          {{ Form::password('new_password', array('class' => 'form-control', 'required')) }}
	                        </div>

	                        <div style="padding-top:6px;display: inline-block;"><a href="/patient_view">Back</a></div>

	                        {{ Form::submit('Change Password', array('class' => 'btn btn-primary btn-round pull-right')) }}
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

<script type="text/javascript">
$(document).ready(function() {
	
});
</script>
@endsection