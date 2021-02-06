@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Add Disconnection Reason <small class="text-muted">Admin Portal</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> Admin Portal</a></li>
                            <li class="breadcrumb-item"><a href="/admin/client/disconnection_reasons/{{ $client->id }}"><i class="fa fa-user"></i> {{ $client->name }}</a></li>
                            <li class="breadcrumb-item active">Add Disconnection Reason</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">{{ $client->name }}</div>

                <div class="panel-body">
                  <div class="row col-md-3">
                      {{ Html::ul($errors->all()) }}

                      {{ Form::open(array('url' => '/admin/client/disconnection_reason/store', 'id' => 'form-add-disconnection-reason')) }}
                        <div class="form-group">
                          {{ Form::label('cause', 'Cause') }}
                          {{ Form::text('cause', Input::old('cause'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('solution', 'Solution') }}
                          {{ Form::text('solution', Input::old('solution'), array('class' => 'form-control')) }}
                        </div>

                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                        {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-round')) }}
                      {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
