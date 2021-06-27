@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>New Inventory <small class="text-muted">Add new inventory into the system</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/home"><i class="fa fa-home"></i> {{ Auth::user()->client->name }}</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">New Inventory</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">New Inventory</div>

                <div class="panel-body">
                  <div class="row" style="color: red;">
                       {{ Html::ul($errors->all()) }}
                  </div>

                  <div class="row col-md-3">
                    {{ Form::open(array('url' => 'inventory')) }}
                      <div class="form-group">
                        {{ Form::label('name', 'Inventory Name') }}
                        {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'required')) }}
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
