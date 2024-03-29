@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>New Clinic <small class="text-muted">Register new clinic</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color: #fff;">New Clinic</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">New Clinic</div>

                <div class="panel-body">
                  <div class="row col-md-3">
                      {{ Html::ul($errors->all()) }}

                      {{ Form::open(array('url' => 'clinic', 'id' => 'form-add-clinic')) }}
                        <div class="form-group">
                          {{ Form::label('name', 'Name') }}
                          {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('address', 'Address') }}
                          {{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                          {{ Form::label('contact_number', 'Contact No.') }}
                          {{ Form::text('contact_number', Input::old('contact_number'), array('class' => 'form-control')) }}
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
