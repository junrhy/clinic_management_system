@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Patient</div>

                <div class="panel-body">
                  <h4>Personal Details</h4>
                  First Name: {{ $patient->first_name }} <br>
                  Middle Name: {{ $patient->middle_name }} <br>
                  Last Name: {{ $patient->last_name }} <br>
                  Name of Father: {{ $patient->name_of_father }} <br>
                  Name of Mother: {{ $patient->name_of_mother }} <br>
                  Mother's Maiden Name: {{ $patient->mother_maiden_name }} <br>
                  Age: {{ $patient->age }} <br>
                  Gender: {{ $patient->gender }} <br>
                  Civil Status: {{ $patient->civil_status }} <br>
                  No. of Children: {{ $patient->number_of_children }} <br>
                  Email: {{ $patient->email }} <br>
                  Contact No.: {{ $patient->contact_number }} <br>
                  Address 1: {{ $patient->address1 }} <br>
                  Address 2: {{ $patient->address2 }} <br>
                  Town: {{ $patient->town }} <br>
                  Province: {{ $patient->province }} <br>
                  Country: {{ $patient->country }} <br>

                  <h4>Work</h4>
                  Occupation: {{ $patient->occupation }} <br>
                  Company Name: {{ $patient->company_name }} <br>
                  Company Address: {{ $patient->company_address }} <br>
                  Company Email: {{ $patient->company_email }} <br>
                  Company Contact No.: {{ $patient->company_contact_number }} <br>

                  <h4>Emergency</h4>
                  Name: {{ $patient->emergency_contact_name1 }} <br>
                  Contact No.: {{ $patient->emergency_contact_number1 }} <br>
                  Name: {{ $patient->emergency_contact_name2 }} <br>
                  Contact No.: {{ $patient->emergency_contact_number2 }} <br>
                  Name: {{ $patient->emergency_contact_name3 }} <br>
                  Contact No.: {{ $patient->emergency_contact_number3 }} <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
