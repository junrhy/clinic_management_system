@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Role</div>

                <div class="panel-body">
                  <form class="" action="{{ url('users/roles') }}" method="post">
                    {{ csrf_field() }}
                    <label for="name">Name</label>
                    <input type="text" name="name" value="">
                    <br>
                    <label for="description">Description</label>
                    <input type="text" name="description" value="">
                    <br>
                    <input type="submit" value="Save">
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
