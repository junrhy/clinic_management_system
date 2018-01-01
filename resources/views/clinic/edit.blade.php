@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Clinic</div>

                <div class="panel-body">
                  {{ Form::model($clinic, array('route' => array('clinic.update', $clinic->id), 'method' => 'PUT')) }}
                    <div class="form-group">
                      {{ Form::label('name', 'Name') }}
                      {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                      {{ Form::label('address', 'Address') }}
                      {{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
                    </div>
                    
                    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
