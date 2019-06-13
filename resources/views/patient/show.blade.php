@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Patient</div>

                <div class="panel-body">
                  First Name: {{ $patient->first_name }} <br>
                  Last Name: {{ $patient->last_name }} <br>
                  Gender: {{ $patient->gender }} <br>
                  Email: {{ $patient->email }} <br>
                  Contact No.: {{ $patient->contact_number }} <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
