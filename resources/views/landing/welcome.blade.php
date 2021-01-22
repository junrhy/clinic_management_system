@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 m-t-200">
        	<br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        @if ($domain && $domain->client->logo != "")
                            <img src="{{ $domain->client->logo }}" class="col-md-12 col-sm-12 col-xs-12">
                            <br><br><br><br>
                        @else
                            <h3 class="text-center" style="font-weight:bold;color:#01d8da;"><i class="fa fa-clinic-medical"></i> Clinic Management System</h3>
                        @endif
                    </div>
                </div>

                <div class="panel-body">
                    <div class="col-md-6 col-md-offset-3">
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
