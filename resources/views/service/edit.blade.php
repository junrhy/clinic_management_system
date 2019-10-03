@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Service</div>

                <div class="panel-body">
                  {{ Form::model($service, array('route' => array('service.update', $service->id), 'method' => 'PUT')) }}
                    {{ Html::ul($errors->all()) }}

                    <div class="form-group col-md-12">
                      {{ Form::label('name', 'Name') }}
                      {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="col-md-12">
                      {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
