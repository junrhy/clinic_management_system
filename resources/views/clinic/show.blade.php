@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clinic</div>

                <div class="panel-body">
                  Name: {{ $clinic->name }}<br>
                  Address: {{ $clinic->address }}<br>
                  Contact No.: {{ $clinic->contact_number }}<br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
