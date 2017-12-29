@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Roles</div>

                <div class="panel-body">
                  <a class="btn btn-primary" href="{{ url('users/role_members/create') }}">Add Role Members</a><br><br>
                  <table class="table">
                    <tr>
                      <td>User</td>
                      <td>Role</td>
                      <td>Action</td>
                    </tr>
                    <?php foreach ($role_members as $role_member_key => $role_member_item): ?>
                    <tr>
                      <td>{{ $role_member_item->user->name }}</td>
                      <td>{{ $role_member_item->role->name }}</td>
                      <td>
                        <a class='btn btn-success' href="{{ route('role_members.show',$role_member_item->id) }}">Show</a>
                        <a class='btn btn-warning' href="{{ route('role_members.edit',$role_member_item->id) }}">Edit</a>
                        {{ Form::open(array('url' => 'users/role_members/' . $role_member_item->id, 'class' => 'pull-right')) }}
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
