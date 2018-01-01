@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Patients</div>

                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('patient/create') }}">Add Patient</a>
                    <br><br>
                    <table class="table">
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($patients as $patient_key => $patient_item): ?>
                      <tr>
                        <td>{{ $patient_item->first_name }}</td>
                        <td>{{ $patient_item->last_name }}</td>
                        <td>{{ $patient_item->age }}</td>
                        <td>
                            <a class='btn btn-success' href="{{ route('patient.show',$patient_item->id) }}">Show</a>
                            <a class='btn btn-warning' href="{{ route('patient.edit',$patient_item->id) }}">Edit</a>
                            {{ Form::open(array('url' => 'patient/' . $patient_item->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
