@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Roles</div>

                <div class="panel-body">
                    <a href="{{ url('users/roles/create') }}">Add Role</a><br>
                    <table cellspacing=0 cellpadding=1 border=1>
                      <tr>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Action</td>
                      </tr>
                      <?php foreach ($roles as $role_key => $role_item): ?>
                      <tr>
                        <td>{{ $role_item->name }}</td>
                        <td>{{ $role_item->description }}</td>
                        <td>
                          <a href="{{ route('roles.edit',$role_item->id) }}">Edit</a> |
                          <a href="{{ route('roles.destroy',$role_item->id) }}">Delete</a>
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
