@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Therapist</div>

                <div class="panel-body">
                  First Name: {{ $therapist->first_name }} <br>
                  Middle Name: {{ $therapist->middle_name }} <br>
                  Last Name: {{ $therapist->last_name }} <br>
                  Age: {{ $therapist->age }} <br>
                  Gender: {{ $therapist->gender }} <br>
                  Civil Status: {{ $therapist->civil_status }} <br>
                  Email: {{ $therapist->email }} <br>
                  Contact No.: {{ $therapist->contact_number }} <br>
                  Address 1: {{ $therapist->address1 }} <br>
                  Address 2: {{ $therapist->address2 }} <br>
                  Town: {{ $therapist->town }} <br>
                  Province: {{ $therapist->province }} <br>
                  Country: {{ $therapist->country }} <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
