@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Role Members</div>

                <div class="panel-body">
                  <br>
                  <table class="table">
                    <tr>
                      <th>Role</th>
                      <th>Members</th>
                    </tr>
                    <?php foreach ($roles as $role_key => $role_item): ?>
                    @if($role_item->name != 'Client User')
                    <tr>
                      <td>{{ $role_item->name }}</td>
                      <td>
                        <a href="{{ route('role_members.show',$role_item->id) }}">{{ $role_item->users->count() > 0 ? $role_item->users->count() : 'Add' }} Staff</a>
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
