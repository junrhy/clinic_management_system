@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 m-t-200">
        	<br>
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-center" style="font-weight:bold;color:#01d8da;"><i class="fa fa fa-clinic-medical"></i> Logo Here</h3></div>

                <div class="panel-body">
                    <div class="">
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
