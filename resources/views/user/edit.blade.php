@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Edit User <small class="text-muted">Welcome to {{ Auth::user()->client->name }}</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item">User</li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>

                <div class="panel-body">
                  @if (count($errors) > 0)
                     <span style="color:red">
                        {{ Html::ul($errors->all()) }}
                     </span>
                  @endif

                  <div class="row col-md-3">
                    {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}
                      <div class="form-group">
                        {{ Form::label('first_name', 'First Name') }}
                        {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('last_name', 'Last Name') }}
                        {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
                      </div>

                      {{ Form::submit('Save Changes', array('class' => 'btn btn-primary btn-round')) }}
                    {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
