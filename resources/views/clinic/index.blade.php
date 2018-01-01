@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clinics</div>

                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('clinic/create') }}">Add Clinic</a>
                    <br><br>
                    <table class="table">
                      <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($clinics as $clinic_key => $clinic_item): ?>
                      <tr>
                        <td>{{ $clinic_item->name }}</td>
                        <td>{{ $clinic_item->address }}</td>
                        <td>
                            <a class='btn btn-success' href="{{ route('clinic.show',$clinic_item->id) }}">Show</a>
                            <a class='btn btn-warning' href="{{ route('clinic.edit',$clinic_item->id) }}">Edit</a>
                            {{ Form::open(array('url' => 'clinic/' . $clinic_item->id, 'class' => 'pull-right')) }}
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
