@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Roles</div>

                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('users/roles/create') }}">Add Role</a><br><br>
                    <table class="table">
                      <tr>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Number of Users</td>
                        <td>Action</td>
                      </tr>
                      <?php foreach ($roles as $role_key => $role_item): ?>
                      <tr>
                        <td>{{ $role_item->name }}</td>
                        <td>{{ $role_item->description }}</td>
                        <td>{{ $role_item->users->count() }}</td>
                        <td>
                          <a class='btn btn-success' href="{{ route('roles.show',$role_item->id) }}">Show</a>
                          <a class='btn btn-warning' href="{{ route('roles.edit',$role_item->id) }}">Edit</a>
                          {{ Form::open(array('url' => 'users/roles/' . $role_item->id, 'class' => 'pull-right')) }}
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
