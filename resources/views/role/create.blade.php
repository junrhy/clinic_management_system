@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Role</div>

                <div class="panel-body">
                  {{ Html::ul($errors->all()) }}

                  {{ Form::open(array('url' => 'users/roles')) }}
                    <div class="form-group">
                      {{ Form::label('name', 'Name') }}
                      {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                      {{ Form::label('description', 'Description') }}
                      {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
                    </div>

                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
