@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Service</div>

                <div class="panel-body">
                  {{ Html::ul($errors->all()) }}

                  {{ Form::open(array('url' => 'service')) }}
                    <div class="form-group col-md-12">
                      {{ Form::label('name', 'Name') }}
                      {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'required')) }}
                    </div>

                    <div class="col-md-12">
                      {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
