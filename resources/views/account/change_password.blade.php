@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Change Password <small class="text-muted">Welcome to {{ Auth::user()->client->name }}</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">Profile</li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ul>
                    </div>
                </div>
            </div>
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
                      {{ Form::password('password', array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="form-group">
                      {{ Form::label('new_password', 'New Password') }}
                      {{ Form::password('new_password', array('class' => 'form-control', 'required')) }}
                    </div>

                    {{ Form::submit('Change Password', array('class' => 'btn btn-primary btn-round pull-right')) }}
       		       {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection