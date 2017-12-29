@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Role Members</div>

                <div class="panel-body">
                  <table class="table">
                    <tr>
                      <td>Role</td>
                      <td>Members</td>
                    </tr>
                    <?php foreach ($roles as $role_key => $role_item): ?>
                    <tr>
                      <td>{{ $role_item->name }}</td>
                      <td>
                        <a href="{{ route('role_members.show',$role_item->id) }}">{{ $role_item->users->count() }}</a>
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
