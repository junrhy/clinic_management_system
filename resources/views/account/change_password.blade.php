@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>

                <div class="panel-body">
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

                  {{ Form::open(array('url' => 'update_password')) }}
                  	<div class="form-group">
                      {{ Form::label('email', 'Email') }}
                      {{ Form::text('email', $email, array('class' => 'form-control', 'readonly')) }}
                    </div>

                    <div class="form-group">
                      {{ Form::label('password', 'Password') }}
                      {{ Form::text('password', null, array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group">
                      {{ Form::label('new_password', 'New Password') }}
                      {{ Form::text('new_password', null, array('class' => 'form-control', 'required')) }}
                    </div>

                    {{ Form::submit('Change Password', array('class' => 'btn btn-primary pull-right')) }}
       		       {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection