@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 m-t-200">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if ($domain && $domain->client->logo != "")
                        <a href="/"><img src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/'. $domain->client->logo) }}" class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 col-xs-offset-1"></a>
                        <br><br><br><br><br>
                    @else
                        <div class="row">
                            <img src="/img/brand/bluewhalecms.png" class="col-md-12 col-md-offset-2" style="width: 350px;">
                        </div>
                    @endif
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Enter username" value="{{ old('username') }}" required autofocus>
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-circle"></i>
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                              </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

 <!--                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg btn-round btn-block">
                                        Sign In
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-8 col-md-offset-1">
                                <br>
                                <a class="btn btn-link btn-forgot-password" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a><!--  | 
                                <a class="btn btn-link btn-register" href="{{ route('register') }}">
                                    Register
                                </a> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
