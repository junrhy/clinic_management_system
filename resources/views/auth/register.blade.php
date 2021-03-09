@extends('layouts.register')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 m-t-30">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @if ($domain && $domain->client->logo != "")
                        <a href="/"><img src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/'. $domain->client->logo) }}" class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 col-xs-offset-1"></a>
                    @else
                        <h3 class="text-center" style="font-weight:bold;color:#ffffff;">
                          <i class="fa fa-clinic-medical"></i> Clinic Management Software
                        </h3>
                    @endif
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="Company Name" value="{{ old('name') }}" required autofocus autocomplete="off" maxlength="30">
                                    <span class="input-group-addon">
                                        <i class="fa fa-clinic-medical"></i>
                                    </span>
                                </div>
                                <div class="col-md-12">
                                    <small>Your website URL:</small><br>
                                    <span id="subdomain"></span>.bluewhalecms.com
                                </div>
                                <div class="col-md-12">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif

                                    @if ($errors->has('domain_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('domain_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

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
                                    <input id="username" type="username" class="form-control" name="username" placeholder="Username" required>
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

                        @if ($domain != "")
                            <input type="hidden" name="distributor_code" value="{{ $domain->distributor_code != '' ? $domain->distributor_code : '0000' }}">
                        @else
                            <input type="hidden" name="distributor_code" value="0000">
                        @endif
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="submit" class="btn btn-register btn-block">
                                        Register
                                    </button>
                                </div>

                                <div class="col-md-8">
                                    <br>
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                       You already have a membership?
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <a class="btn btn-link" href="/">
                                        Return to Homepage
                                    </a>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="domain_name" value="">
                    </form>
                </div>
            </div>
            <br>
            <div class="text-center">Copyright &copy; 2021 - Clinic Management Software by <a href="https://www.bluewhalecms.com" target="_BLANK">Bluewhale CMS</a></div>
        </div>
    </div>
</div>
@endsection

@section('page_level_footer_script')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(function(){
        var subdomain = $("#name").val().replace(/\s/g, '').toLowerCase();
        $("input[name='domain_name']").val(subdomain + '.bluewhalecms.com');
    });

    $("#name").on("keyup change", function(e) {
        var regex = /[^a-zA-Z0-9\s]/;
        var input = $("#name").val();

        if(regex.test(input)) {
            e.preventDefault();
            $("#name").val(input.slice(0, -1));
        } else {
            var subdomain = input.replace(/\s/g, '').toLowerCase();

            $("#subdomain").html(subdomain);
            $("input[name='domain_name']").val(subdomain + '.bluewhalecms.com');
        }
    });
});
</script>
@endsection
