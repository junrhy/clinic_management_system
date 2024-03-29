@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>New Staff <small class="text-muted">Add new staff who can access this system</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">New Staff</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">New Staff</div>

                <div class="panel-body">
                  @if (count($errors) > 0)
                     <span style="color:red">
                        {{ Html::ul($errors->all()) }}
                     </span>
                  @endif

                  <div class="row col-md-3">
                    {{ Form::open(array('url' => 'user', 'id' => 'form-add-user')) }}
                      <div class="form-group">
                        {{ Form::label('first_name', 'First Name') }}
                        {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('last_name', 'Last Name') }}
                        {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('username', 'Username') }}
                        {{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('password', 'Password') }}
                        {{ Form::password('password', array('class' => 'form-control', 'required')) }}
                      </div>

                      {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-round')) }}
                    {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
