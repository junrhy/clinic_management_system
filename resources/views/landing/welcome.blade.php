@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 m-t-200">
        	<br>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-center" style="font-weight:bold;color:#01d8da;"><i class="fa fa fa-clinic-medical"></i> Logo Here</h3></div>

                <div class="panel-body">
                 	<div class="col-md-6">
                        <a href="{{ route('register') }}" class="btn btn-info btn-lg btn-block">
                            Register
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-block">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
