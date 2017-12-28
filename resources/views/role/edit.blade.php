@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Role</div>

                <div class="panel-body">
                  {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
                    <div class="form-group">
                      {{ Form::label('name', 'Name') }}
                      {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                      {{ Form::label('description', 'Description') }}
                      {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
                    </div>
                    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
