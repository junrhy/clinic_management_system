@extends('layouts.register')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 m-t-30">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center" style="font-weight:bold;color:#01d8da;"><i class="fa fa-user"></i> Admin User Registration</h3>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('create_admin_user') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="first_name" type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autofocus>
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>  
                                <div class="col-md-12">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required autofocus>
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>  
                                <div class="col-md-12">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" required>
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>  
                                <div class="col-md-12">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="contact" type="text" class="form-control" name="contact" placeholder="Contact Number" value="{{ old('contact') }}" required autofocus>
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>  
                                <div class="col-md-12">
                                    @if ($errors->has('contact'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('contact') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Username" required>
                                    <span class="input-group-addon">
                                        <i class="fa fa-user-lock"></i>
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
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>  
                                <div class="col-md-12">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="pin" type="text" class="form-control" name="pin" placeholder="Pin Code" required>
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>  
                                <div class="col-md-12">
                                    @if ($errors->has('pin'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block btn-round">
                                        Register
                                    </button>
                                    <br>
                                    <div class="text-center"><a href="{{ route('login') }}">You already have a membership?</a></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
