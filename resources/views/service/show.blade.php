@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-user-md"></i> Service</div>

                <div class="panel-body">
                  Name: {{ $service->name }} <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
