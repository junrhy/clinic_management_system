@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Doctors</div>

                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('doctor/create') }}">Add Doctor</a>
                    <br><br>
                    <table class="table">
                      <tr>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($doctors as $doctor_key => $doctor_item): ?>
                      <tr>
                        <td>{{ $doctor_item->name }}</td>
                        <td>
                            <a class='btn btn-success' href="{{ route('doctor.show',$doctor_item->id) }}">Show</a>
                            <a class='btn btn-warning' href="{{ route('doctor.edit',$doctor_item->id) }}">Edit</a>
                            {{ Form::open(array('url' => 'doctor/' . $doctor_item->id, 'class' => 'pull-right')) }}
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
