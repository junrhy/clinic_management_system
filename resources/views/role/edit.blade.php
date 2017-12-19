@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Role</div>

                <div class="panel-body">
                  <form class="" action="{{ route('roles.update', $role->id) }}" method="put">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $role->name }}">
                    <br>
                    <label for="description">Description</label>
                    <input type="text" name="description" value="{{ $role->description }}">
                    <br>
                    <input type="submit" value="Save">
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
