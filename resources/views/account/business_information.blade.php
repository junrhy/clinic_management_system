@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Business Information</div>

                <div class="panel-body">
 	              @if (count($errors) > 0)
				     <span style="color:red">
			            {{ Html::ul($errors->all()) }}
			         </span>
				  @endif

				  @if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>	
				        <strong>{{ $message }}</strong>
					</div>
				  @endif

                  {{ Form::open(array('url' => 'update_business_information')) }}
                    <div class="form-group">
                      {{ Form::hidden('email', $user->client->email, array('class' => 'form-control')) }}
                    </div>

                  	<div class="form-group">
                      {{ Form::label('name', 'Business Name') }}
                      {{ Form::text('name', $user->client->name, array('class' => 'form-control')) }}
                    </div>

                    {{ Form::submit('Update', array('class' => 'btn btn-primary pull-right')) }}
       		       {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection