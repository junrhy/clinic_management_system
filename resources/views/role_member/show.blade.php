@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Role Members</div>

                <div class="panel-body">
                  Name: {{ $role->name }}<br>
                  Description: {{ $role->description }}<br>
                  <br>
                  <strong>Members</strong><br><br>
                  <div class="row">
                    {{ Form::open(array('url' => 'users/role_members')) }}
                      <div class="col-md-4">
                        {{ Form::select('user_id', $users, null, ['class' => 'form-control']) }}
                      </div>

                      {{ Form::hidden('role_id', $role->id) }}
                      {{ Form::submit('Add Staff', array('class' => 'btn btn-primary')) }}
                    {{ Form::close() }}
                  </div>
                  <br>
                  @if (session('status'))
                      <div class="alert alert-success">
                          {{ session('status') }}
                      </div>
                  @endif
                  <table class="table">
                    <tr>
                      <td colspan=2>Name</td>
                    </tr>
                    <?php foreach ($role->users as $user_key => $user): ?>
                    @if($user->email != $user->client->email)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>
                          {{ Form::open(array('url' => 'users/role_members/' . $user->id, 'class' => 'pull-right')) }}
                              {{ Form::hidden('role_id', $role->id) }}
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
