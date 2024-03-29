@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>New Doctor <small class="text-muted">Add new doctor into the system</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">New Doctor</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">New Doctor</div>

                <div class="panel-body">
                  <div class="row col-md-3">
                    {{ Html::ul($errors->all()) }}

                    {{ Form::open(array('url' => 'doctor')) }}
                      <div class="form-group">
                        {{ Form::label('first_name', 'First Name') }}
                        {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('last_name', 'Last Name') }}
                        {{ Form::text('last_name', Input::old('last_name'), array('class' => 'form-control', 'required')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('license_no', 'License Number') }}
                        {{ Form::text('license_no', Input::old('license_no'), array('class' => 'form-control')) }}
                      </div>

                      <div class="form-group">
                        {{ Form::label('ptr_no', 'PTR Number') }}
                        {{ Form::text('ptr_no', Input::old('ptr_no'), array('class' => 'form-control')) }}
                      </div>

                      <div>
                        {{ Form::submit('Submit', array('class' => 'btn btn-primary btn-round')) }}
                      </div>
                    {{ Form::close() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
