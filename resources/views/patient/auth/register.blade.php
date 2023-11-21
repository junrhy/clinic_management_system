@extends('layouts.register')

@section('page_level_css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if ($domain)
                <div class="row">
                    @if($domain->client->logo != "")
                        <br>
                        @if(env('FILESYSTEM_DRIVER') == 'spaces')
                        <img src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/'. $domain->client->logo) }}" class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                        @endif

                        @if(env('FILESYSTEM_DRIVER') == 'public')
                        <img src="{{ asset('storage/' . $domain->client->logo) }}" id="logo" class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
                        @endif
                    @else
                        <h3 class="text-center" style="font-weight:bold;color:#018d8e;">{{ $domain->client->name }}</h3>
                    @endif
                </div>
                <br>
            @else
                <br>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center" style="font-weight:bold;color:#018d8e;"><i class="fa fa-notes-medical"></i> Patient Registration Form</h3>
                </div>
                
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('create_patient_user') }}">
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

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="dob" type="text" class="form-control" name="dob" placeholder="Date of Birth" value="{{ old('dob') }}" autocomplete="off" required autofocus>
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>  
                                <div class="col-md-12">
                                    @if ($errors->has('dob'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('dob') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <select name="gender" class='form-control'>
                                        <option value=''>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Prefer not to say</option>
                                    </select>
                                    <span class="input-group-addon">
                                        <i class="fa fa-venus-mars"></i>
                                    </span>
                                </div>  
                                <div class="col-md-12">
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="input-group input-lg">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}">
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

                        @if ($domain)
                        <input type="hidden" name="client_id" value="{{ $domain->client->id }}">
                        @endif

                        @if (isset($_GET['profile']))
                        <input type="hidden" name="client_id" value="{{ $_GET['cid'] }}">
                        @endif

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="col-md-12">
                                    @if ($domain || isset($_GET['profile']) )
                                    <button type="submit" class="btn btn-register btn-block">Register</button>
                                    @else
                                    <button type="submit" class="btn btn-block" disabled>Registration not available. Contact Administrator.</button>
                                    @endif
                                    <br>
                                    <div class="text-center"><a href="{{ route('login') }}">You already have a membership?</a></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <br>
            <div class="text-center">
                Copyright &copy; 2021 - Clinic Management Software
            </div>
            <br>
        </div>
    </div>
</div>
@endsection

@section('page_level_footer_script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#dob").datepicker({  
    maxDate: '0',
    format: 'mm/dd/yyyy',
    changeMonth: true,
    changeYear: true,
    // isRTL: true
  });

  $('select[name=gender]').val(null);
});
</script>
@endsection