@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Role</div>

                <div class="panel-body">
                  Name: {{ $role->name }}<br>
                  Description: {{ $role->description }}<br>
                  <br>
                  <strong>Members</strong> <br>
                  <?php foreach ($role->users as $user_key => $user_item): ?>
                  {{ $user_item->name }}<br>
                  <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
