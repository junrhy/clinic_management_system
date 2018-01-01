@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Therapists</div>

                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('therapist/create') }}">Add Therapist</a>
                    <br><br>
                    <table class="table">
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($therapists as $therapist_key => $therapist_item): ?>
                      <tr>
                        <td>{{ $therapist_item->first_name }}</td>
                        <td>{{ $therapist_item->last_name }}</td>
                        <td>{{ $therapist_item->age }}</td>
                        <td>
                            <a class='btn btn-success' href="{{ route('therapist.show',$therapist_item->id) }}">Show</a>
                            <a class='btn btn-warning' href="{{ route('therapist.edit',$therapist_item->id) }}">Edit</a>
                            {{ Form::open(array('url' => 'therapist/' . $therapist_item->id, 'class' => 'pull-right')) }}
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
