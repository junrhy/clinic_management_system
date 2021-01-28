<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Auth::user()->client->name }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

    @yield('page_level_script')
    @yield('page_level_css')
</head>
<body>
    <div id="progress" class="waiting">
        <dt></dt>
        <dd></dd>
    </div>
    <input type="hidden" data-account-type="{{ Auth::user()->client->account_type }}" id="check-account-type">
    <input type="hidden" data-clinic-count="{{ Auth::user()->client->clinics->count() }}" id="check-clinic-count">
    <input type="hidden" data-patient-count="{{ Auth::user()->client->patients->count() }}" id="check-patient-count">
    <input type="hidden" data-user-count="{{ Auth::user()->client->users->count() }}" id="check-user-count">
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            
            @if ($domain && $domain->client->logo != "")
            <div class="sidebar-header" style="padding: 0px;">
                <h3 class="row" style="margin: 0px;">
                    <a href="/"><img src="{{ $domain->client->logo }}" id="logo" class="" style="margin: 3px;width: 97%;"></a>
                </h3>
            
                <strong style="padding-top:20px;"><i class="fa fa-clinic-medical"></i> <br>{{ substr(Auth::user()->client->name, 0, 1) }}</strong>
            </div>
            @else
            <div class="sidebar-header">
                <h3 class="text-center">
                    <i class="fa fa-clinic-medical"></i> 
                    <br>
                    <small style="color: #01d8da;">{{ Auth::user()->client->name }}</small>
                </h3>

                <strong><i class="fa fa-clinic-medical"></i> <br>{{ substr(Auth::user()->client->name, 0, 1) }}</strong>
            </div>
            @endif
                               

            <ul class="list-unstyled components">
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('dashboard', Auth::user()->id) }}">
                    <a href="{{ url('home') }}"><i class="fa fa-chalkboard"></i> Dashboard</a>
                </li>

              @if(Auth::user()->client->is_active && Auth::user()->client->is_suspended == 0)
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('calendar', Auth::user()->id) }}">
                    <a href="{{ url('calendar') }}"><i class="fa fa-calendar"></i> Appointment</a>
                </li>
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('dental', Auth::user()->id) }}">
                    <a href="{{ url('/dental_chart') }}"><i class="fa fa-tooth"></i> Dental</a>
                </li>
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('patients', Auth::user()->id) }}">
                    <a href="#patientSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-notes-medical">
                        </i> Patients</a>

                    <ul class="collapse list-unstyled" id="patientSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('patients', Auth::user()->id) }}">
                            <a href="{{ url('patient') }}">All Patients</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('add_patient', Auth::user()->id) }}">
                            <a href="{{ url('patient/create') }}">Add Patient</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('clinics', Auth::user()->id) }}">
                    <a href="#clinicSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-clinic-medical"></i> 
                        Clinics</a>

                    <ul class="collapse list-unstyled" id="clinicSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('clinics', Auth::user()->id) }}">
                            <a href="{{ url('clinic') }}">All Clinics</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('add_clinic', Auth::user()->id) }}">
                            <a href="{{ url('clinic/create') }}">Add Clinic</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('doctors', Auth::user()->id) }}">
                    <a href="#doctorSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-user-md"></i> 
                        Doctors</a>

                    <ul class="collapse list-unstyled" id="doctorSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('doctors', Auth::user()->id) }}">
                            <a href="{{ url('doctor') }}">All Doctors</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('add_doctor', Auth::user()->id) }}">
                            <a href="{{ url('doctor/create') }}">Add Doctor</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('services', Auth::user()->id) }}">
                    <a href="#serviceSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-briefcase-medical"></i> 
                        Services</a>

                    <ul class="collapse list-unstyled" id="serviceSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('services', Auth::user()->id) }}">
                            <a href="{{ url('service') }}">All Services</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('add_service', Auth::user()->id) }}">
                            <a href="{{ url('service/create') }}">Add Service</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('billing', Auth::user()->id) }}">
                    <a href="#billingSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-file-alt"></i> 
                        &nbsp;Billing</a>

                    <ul class="collapse list-unstyled" id="billingSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('view_billing_invoices', Auth::user()->id) }}">
                            <a href="{{ url('invoice') }}">All Invoices</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('view_billing_payments', Auth::user()->id) }}">
                            <a href="{{ url('payment') }}">All Payments</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('users', Auth::user()->id) }}">
                    <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-users"></i> 
                        Users</a>

                    <ul class="collapse list-unstyled" id="userSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('users', Auth::user()->id) }}">
                            <a href="{{ url('user') }}">All Users</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('add_user', Auth::user()->id) }}">
                            <a href="{{ url('user/create') }}">Add User</a>
                        </li>
                    </ul>
                </li>
              @endif
                
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('settings', Auth::user()->id) }}">
                    <a href="#profileSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-user-cog"></i>
                        Settings
                    </a>
                    <ul class="collapse list-unstyled" id="profileSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('edit_business_information', Auth::user()->id) }}">
                            <a href="{{ url('business_information') }}">Company Profile</a>
                        </li>

                        <li>
                            <a href="{{ url('change_password') }}">Change Password</a>
                        </li>

                        @if(Auth::user()->client->account_type == 'free' && Auth::user()->client->is_active != 0 && Auth::user()->client->is_suspended != 1)
                        <li>
                            <a style="cursor:pointer;" id="sidebar-menu-upgrade-account">Upgrade</a>
                        </li>
                        @endif

                        @if(Auth::user()->client->is_active == 0 && Auth::user()->client->account_type == 'basic')
                        <li>
                            <a style="cursor:pointer;" id="sidebar-menu-activate-account">Activate my Account</a>
                        </li>
                        @endif

                        @if(Auth::user()->client->is_active != 0 && Auth::user()->client->is_suspended == 1)
                            <a style="cursor:pointer;" id="sidebar-menu-reactivate-account">Request to Reactivate Account</a>
                        @endif
                    </ul>
                </li>
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

                        <div class="float-right" style="margin: 8px;font-size: 11pt;color:#fff;">
                            Account Type: <strong>{{ ucfirst(Auth::user()->client->account_type) }}</strong> 

                            @if(Auth::user()->client->is_active == 0)
                                <strong style="color:#000;">( This account is not active )</strong>
                            @endif

                            @if(Auth::user()->client->is_suspended == 1)
                                <strong style="color:#000;">( This account is suspended )</strong>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <div id="below-nav-design" style="height:200px;position:absolute;left:0px;top:50px;z-index: -1;background-color: #01d8da;"></div>

            @yield('content')
        </div>
    </div>

    @include('account._upgrade_account')
    @include('account._activate_account')
    @include('account._reactivate_account')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('page_level_footer_script')
</body>
<script type="text/javascript">
$(document).ready(function () {
    update_below_nav_width();

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');

        update_below_nav_width();
    });

    function update_below_nav_width() {
        var width = $(window).width();

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            // ipad landscape
            if ($(window).width() == 1024) {
                if ($('#sidebar').hasClass('active')) {
                    width = width + 74;
                } else {
                    width = width + 224;
                }
            }

            // ipad landscape
            if ($(window).width() == 768) {
                if ($('#sidebar').hasClass('active')) {
                    width = width + 100;
                }
            }
        }

        $("#below-nav-design").css("width", width);
    }

    $(window).resize(function() {
        $("#below-nav-design").width("100%");
    });

});
</script>
</html>
