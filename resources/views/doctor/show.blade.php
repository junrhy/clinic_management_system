@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Doctor</div>

                <div class="panel-body">
                  First Name: {{ $doctor->first_name }} <br>
                  Middle Name: {{ $doctor->middle_name }} <br>
                  Last Name: {{ $doctor->last_name }} <br>
                  Age: {{ $doctor->age }} <br>
                  Gender: {{ $doctor->gender }} <br>
                  Civil Status: {{ $doctor->civil_status }} <br>
                  Email: {{ $doctor->email }} <br>
                  Contact No.: {{ $doctor->contact_number }} <br>
                  Address 1: {{ $doctor->address1 }} <br>
                  Address 2: {{ $doctor->address2 }} <br>
                  Town: {{ $doctor->town }} <br>
                  Province: {{ $doctor->province }} <br>
                  Country: {{ $doctor->country }} <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
