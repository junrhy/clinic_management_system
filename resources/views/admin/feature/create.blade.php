@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>New Feature <small class="text-muted">Add new feature into the system</small></h2>
                    </div>            
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <ul class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-home"></i> Admin Panel</a></li>
                            <li class="breadcrumb-item active"><strong style="color:#fff;">New Feature</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">New Feature</div>

                <div class="panel-body">
                  <div class="row col-md-3">
                    {{ Html::ul($errors->all()) }}

                    {{ Form::open(array('url' => '/admin/feature/store', 'method' => 'POST')) }}
                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('parent_id', 'Parent ID') }}
                            {{ Form::text('parent_id', null, array('class' => 'form-control', 'required')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('order', 'Order') }}
                            {{ Form::text('order', null, array('class' => 'form-control')) }}
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
