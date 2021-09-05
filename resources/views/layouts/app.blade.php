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
    <style type="text/css">
        .modalOverlay {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            background-color: rgba(0,0,0,0.3); /* black semi-transparent */
            z-index: 800;
        }

        .account_status_message {
            font-family: sans-serif;
            margin: 5px;
            font-weight: bold;
            color: #ff0000;
            display: inline-block;
            text-align: right;
            background-color: #FFFFFF;
            padding: 3px;
        }

        #button-upgrade-account {
            border: 1px solid #FF8C00;
            background: #FF8C00;
            color: #fff;
            margin-right: 20px;
            border-radius: 3px;
            position: relative;
            top: -3px;        }
        }
    </style>
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
            
            @if (auth()->user()->client->logo != "")
            <div class="sidebar-header" style="padding: 0px;">
                <h3 class="row" style="margin: 0px;">
                    @if(env('FILESYSTEM_DRIVER') == 'spaces')
                    <a href="/"><img src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/' . auth()->user()->client->logo) }}" id="logo" class="" style="margin: 30px 3px 3px 3px;height:75px;width: 97%;"></a>
                    @endif

                    @if(env('FILESYSTEM_DRIVER') == 'public')
                    <a href="/"><img src="{{ asset('storage/' . auth()->user()->client->logo) }}" id="logo" class="" style="margin: 30px 3px 3px 3px;height:60px;width: 97%;"></a>
                    @endif
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
                    <a href="{{ url('home') }}"><i class="fa fa-chalkboard"></i>Dashboard</a>
                </li>

                @if(env('APP_ENV') == 'local')
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('messages', Auth::user()->id) }}">
                    <a href="{{ url('message') }}"><i class="fa fa-envelope"></i> Messages</a>
                </li>
                @endif

              @if(Auth::user()->client->is_active && Auth::user()->client->is_suspended == 0)
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('appointment', Auth::user()->id) }}">
                    <a href="#appointmentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-calendar">
                        </i> Appointment</a>

                    <ul class="collapse list-unstyled" id="appointmentSubmenu">
                        <li class="">
                            <a href="{{ url('calendar') }}">Calendar</a>
                        </li>
                        <li class="">
                            <a href="{{ url('/appointment/requests') }}">Requests</a>
                        </li>
                    </ul>
                </li>

                @if( !in_array(Auth::user()->client->account_type, ['free']) )
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('dental', Auth::user()->id) }}">
                    <a href="{{ url('/dental_chart') }}"><i class="fa fa-tooth"></i> Dental</a>
                </li>
                @endif
              @endif

              
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('patients', Auth::user()->id) }}">
                    <a href="#patientSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-notes-medical">
                        </i> Patients</a>

                    <ul class="collapse list-unstyled" id="patientSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('patients', Auth::user()->id) }}">
                            <a href="{{ url('patient') }}">All Patients</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('patients', Auth::user()->id) }}">
                            <a href="{{ url('/patient_registration_requests') }}">Registration Requests</a>
                        </li>
                    </ul>
                </li>

               @if(Auth::user()->client->is_active && Auth::user()->client->is_connected == 0 && Auth::user()->client->is_suspended == 0)
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
                
                @if( !in_array(Auth::user()->client->account_type, ['free']) )
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('inventory', Auth::user()->id) }}">
                    <a href="#inventorySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-box"></i> 
                        Inventory</a>

                    <ul class="collapse list-unstyled" id="inventorySubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('inventory', Auth::user()->id) }}">
                            <a href="{{ url('inventory') }}">All Inventory</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('add_inventory', Auth::user()->id) }}">
                            <a href="{{ url('inventory/create') }}">Add Inventory</a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="{{ App\Model\FeatureUser::is_feature_allowed('billing', Auth::user()->id) }}">
                    <a href="#billingSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-file-alt"></i> 
                        &nbsp;Billing</a>

                    <ul class="collapse list-unstyled" id="billingSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('view_billing_invoices', Auth::user()->id) }}">
                            <a href="{{ url('invoice') }}">All Invoices</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('view_billing_payments', Auth::user()->id) }}">
                            <a href="{{ url('payment') }}">All Payments & Balances</a>
                        </li>
                    </ul>
                </li>

                @if( !in_array(Auth::user()->client->account_type, ['free']) )
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('staffs', Auth::user()->id) }}">
                    <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-users"></i> 
                        Staffs</a>

                    <ul class="collapse list-unstyled" id="userSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('staffs', Auth::user()->id) }}">
                            <a href="{{ url('user') }}">All Staffs</a>
                        </li>
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('add_staff', Auth::user()->id) }}">
                            <a href="{{ url('user/create') }}">Add Staff</a>
                        </li>
                    </ul>
                </li>
                @endif
              @endif
                
                <li class="{{ App\Model\FeatureUser::is_feature_allowed('account', Auth::user()->id) }}">
                    <a href="#profileSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-user-cog"></i>
                        Account
                    </a>
                    <ul class="collapse list-unstyled" id="profileSubmenu">
                        <li class="{{ App\Model\FeatureUser::is_feature_allowed('edit_business_information', Auth::user()->id) }}">
                            <a href="{{ url('business_information') }}">Company Profile</a>
                        </li>

                        <li>
                            <a href="{{ url('change_password') }}">Change Password</a>
                        </li>

                        @if(Auth::user()->client->account_type == 'free' 
                        && Auth::user()->client->is_active != 0 
                        && Auth::user()->client->is_suspended == 0 
                        && Auth::user()->is_client == 1)
                        
                        <li>
                            <a style="cursor:pointer;" id="sidebar-menu-upgrade-account">Upgrade</a>
                        </li>
                        
                        @endif

                        @if(Auth::user()->client->is_active == 0 && Auth::user()->client->account_type == 'basic')
                        <li>
                            <a style="cursor:pointer;color:#FF6065;" id="sidebar-menu-activate-account">Activate Account</a>
                        </li>
                        @endif

                        @if(Auth::user()->client->is_active != 0 && Auth::user()->client->is_suspended == 1)
                            <a style="cursor:pointer;color:#FF6065;" id="sidebar-menu-reactivate-account">Request to Reactivate Account</a>
                        @endif
                    </ul>
                </li>

                @if( !in_array(Auth::user()->client->account_type, ['free', 'enterprise']) && Auth::user()->is_client == 1 )
                <li class="">
                    <a href="#subscriptionSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-credit-card"></i> 
                        Subscription</a>

                    <ul class="collapse list-unstyled" id="subscriptionSubmenu">
                        <li>
                            <a href="{{ url('subscription') }}">Plan</a>
                        </li>
                        <li>
                            <a href="{{ url('payment_method') }}">Payment Method</a>
                        </li>
                        <li>
                            <a href="{{ url('balance_and_usage') }}">Balance</a>
                        </li>
                        <li>
                            <a href="{{ url('view_estatements') }}">Statements</a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="">
                    <a href="{{ url('settings') }}"><i class="fa fa-gear"></i> Settings</a>
                </li>

<!--                 <li class="">
                    <a href="#helpSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-question"></i> 
                        &nbsp;&nbsp;Help Center</a>

                    <ul class="collapse list-unstyled" id="helpSubmenu">
                        <li class="">
                            <a href="{{ url('/tickets') }}">Contact Support</a>
                        </li>
                    </ul>
                </li> -->
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

                        
                        @if(Auth::user()->client->is_active == 0)
                            <span class="account_status_message">ACCOUNT IS NOT ACTIVE</span>
                        @endif

                        @if(Auth::user()->client->is_suspended == 1)
                            <span class="account_status_message">ACCOUNT IS SUSPENDED</span>
                        @endif

                        @if(Auth::user()->client->is_disconnected == 1)
                            <span class="account_status_message">ACCOUNT SERVICE IS ON HOLD</span>
                        @endif
                        

                        <div class="float-right" style="margin: 8px;font-size: 11pt;color:#fff;">
                            @if(Auth::user()->client->account_type == 'free' 
                            && Auth::user()->client->is_active != 0 
                            && Auth::user()->client->is_suspended == 0 
                            && Auth::user()->is_client == 1)
                            
                            <strong style="color:#ffeeda;">Free Plan</strong> <button id="button-upgrade-account">Upgrade</button>
                           
                            @endif

                            <strong><i class="fa fa-user-circle"></i>  {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>
                        </div>
                    </div>
                </div>
            </nav>

            @if(Auth::user()->client->is_disconnected == 1)
                <div class="modalOverlay">
                    
                    <div class="container" style="margin-top: 10em;">
                        <div class="col-md-12">
                            <div class="col-md-8 col-md-offset-2" style="background-color: #fff;border-radius: 5px;">
                                <div class="row" align="center" style="border-bottom: 1px solid #eee;">
                                    <h3 class="col-md-12">Account service is on hold because of the following reasons.</h3>
                                </div>
                                <br>
                                <div>
                                    @foreach(auth()->user()->client->disconnection_reasons as $disconnection_reason)
                                    
                                    <strong>{{ $disconnection_reason->cause }}</strong><br>
                                    {{ $disconnection_reason->solution }}<br>
                                    <br>

                                    @endforeach
                                </div>
                                <div class="row" align="right" style="border-top: 1px solid #eee;padding: 10px;">
                                    <a href="" type="button" data-id="" class="btn btn-upgrade btn-round">Contact Customer Service</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

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
