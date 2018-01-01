@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User</div>

                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ url('user/create') }}">Add User</a>
                    <br><br>
                    <table class="table">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                      <?php foreach ($users as $user_key => $user_item): ?>
                      @if($user_item->email != $user_item->client->email)
                      <tr>
                        <td>{{ $user_item->name }}</td>
                        <td>{{ $user_item->email }}</td>
                        <td>
                            <a class='btn btn-success' href="{{ route('user.show',$user_item->id) }}">Show</a>
                            <a class='btn btn-warning' href="{{ route('user.edit',$user_item->id) }}">Edit</a>
                            {{ Form::open(array('url' => 'user/' . $user_item->id, 'class' => 'pull-right')) }}
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
