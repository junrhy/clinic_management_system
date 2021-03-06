@extends('layouts.account')

<style type="text/css">
  .congratulations {
  	margin-top: 3em;
  	font-size: 24pt;
  }

  .trophy {
    font-size: 180pt;
    color:gold;
  }

  .msg {
  	font-size: 14pt;
  }

  .gotoHomepage {
  	font-size: 14pt;
  }
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="congratulations text-center">Congratulations!</div>
        	<div class="trophy text-center"><i class="fa fa-trophy"></i></div>
        	<br>
            <div class="msg text-center">We are now upgrading your account.</div>
            <br>
            <div class="gotoHomepage text-center"><a href="{{ url('home') }}" class="btn btn-primary btn-round">Go to Homepage</a></div>
        </div>
    </div>
</div>
@endsection
