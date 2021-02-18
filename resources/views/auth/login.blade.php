@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 m-t-200">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @if ($domain && $domain->client->logo != "")
                        <a href="/"><img src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/'. $domain->client->logo) }}" class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 col-xs-offset-1"></a>
                        <br><br><br><br><br>
                    @else
                        <h3 class="text-center" style="font-weight:bold;color:#ffffff;">
                          <i class="fa fa-clinic-medical"></i> Clinic Management Software
                        </h3>
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
                                    <button type="submit" class="btn btn-login btn-lg btn-block">
                                        Sign In
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-4 col-md-offset-1">
                                <br>
                                <a class="btn btn-link btn-forgot-password" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                                <br>
                                <a class="btn btn-link" href="/">
                                    Return to Homepage
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div class="text-center">Copyright &copy; 2021 - Clinic Management Software by <a href="http://clinic-app.junrhy.com" target="_BLANK">Bluewhale CMS</a></div>
        </div>
    </div>
</div>
@endsection
