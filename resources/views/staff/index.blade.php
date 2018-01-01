@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Staff</div>

                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('client/staff/create') }}">Add Staff</a>
                    <br><br>
                    <table class="table">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($staffs as $staff_key => $staff_item): ?>
                      @if($staff_item->email != $staff_item->client->email)
                      <tr>
                        <td>{{ $staff_item->name }}</td>
                        <td>{{ $staff_item->email }}</td>
                        <td>
                            <a class='btn btn-success' href="{{ route('staff.show',$staff_item->id) }}">Show</a>
                            <a class='btn btn-warning' href="{{ route('staff.edit',$staff_item->id) }}">Edit</a>
                            {{ Form::open(array('url' => 'client/staff/' . $staff_item->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                      </tr>
                      @endif
                      <?php endforeach; ?>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
