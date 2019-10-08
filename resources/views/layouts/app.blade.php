<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>

    @yield('page_level_script')
    @yield('page_level_css')
</head>
<body>
    <div id="progress" class="waiting">
        <dt></dt>
        <dd></dd>
    </div>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="text-center"><i class="fa fa-stethoscope"></i> {{ config('app.name', 'Laravel') }}</h3>
                <strong>CA</strong>
            </div>

            <ul class="list-unstyled components">
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><a href="{{ url('home') }}"><i class="fa fa-chalkboard"></i> Dashboard</a></li>
                    <li><a href="{{ url('calendar') }}"><i class="fa fa-calendar"></i> Calendar</a></li>
                    <li>
                        <a href="#patientSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-notes-medical">
                            </i> Patients</a>

                        <ul class="collapse list-unstyled" id="patientSubmenu">
                            <li>
                                <a href="{{ url('patient') }}">All Patients</a>
                            </li>
                            <li>
                                <a href="{{ url('patient/create') }}">Add Patient</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#clinicSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-clinic-medical"></i> 
                            Clinics</a>

                        <ul class="collapse list-unstyled" id="clinicSubmenu">
                            <li>
                                <a href="{{ url('clinic') }}">All Clinics</a>
                            </li>
                            <li>
                                <a href="{{ url('clinic/create') }}">Add Clinic</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#doctorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-user-md"></i> 
                            Doctors</a>

                        <ul class="collapse list-unstyled" id="doctorSubmenu">
                            <li>
                                <a href="{{ url('doctor') }}">All Doctors</a>
                            </li>
                            <li>
                                <a href="{{ url('doctor/create') }}">Add Doctor</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#serviceSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-briefcase-medical"></i> 
                            Services</a>

                        <ul class="collapse list-unstyled" id="serviceSubmenu">
                            <li>
                                <a href="{{ url('service') }}">All Services</a>
                            </li>
                            <li>
                                <a href="{{ url('service/create') }}">Add Service</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-users"></i> 
                            Users</a>

                        <ul class="collapse list-unstyled" id="userSubmenu">
                            <li>
                                <a href="{{ url('user') }}">All Users</a>
                            </li>
                            <li>
                                <a href="{{ url('user/create') }}">Add User</a>
                            </li>
                        </ul>
                    </li>


                    
                    <li>
                        <a href="#profileSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-user"></i>
                            Profile
                        </a>
                        <ul class="collapse list-unstyled" id="profileSubmenu">
                            <li>
                                <a href="{{ url('business_information') }}">Business Information</a>
                            </li>

                            <li>
                                <a href="{{ url('change_password') }}">Change Password</a>
                            </li>

                            @if(Auth::user()->client->account_type == 'basic')
                            <li>
                                <a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7B7DXYEA9FKLA&custom=client_id_{{  Auth::user()->client->id }}">Upgrade Account</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endguest
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-default navbar-static-top" style="background-color: #01d8da;">

                <div class="container-fluid">
                    <a id="sidebarCollapse" class="navbar-brand"><i class="fas fa-exchange-alt"></i></a>

                    <div style="margin-top:6px;">
                        <a class="btn btn-round btn-white float-right" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                        <div class="float-right" style="margin: 8px;font-size: 11pt;color:#fff;">Account Type: <strong>{{ ucfirst(Auth::user()->client->account_type) }}</strong></div>
                    </div>
                </div>
            </nav>

            <div style="height:200px;width:100%;position:absolute;left:0px;top:50px;z-index: -1;background-color: #01d8da;"></div>
            @yield('content')
        </div>


        
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('page_level_footer_script')
</body>
<script type="text/javascript">
$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

});
</script>
</html>
