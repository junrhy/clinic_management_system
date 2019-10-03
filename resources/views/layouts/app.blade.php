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
    
    <style type="text/css">
        .swal2-popup {
            font-size: 1.6rem !important;
        }

        .navbar {
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.15);
        }

        /* navbar */
        .navbar-default {
            background-color: #F8F8F8;
            border-color: #01d8da;
        }
        /* Title */
        .navbar-default .navbar-brand {
            color: #fff;
        }
        .navbar-default .navbar-brand:hover,
        .navbar-default .navbar-brand:focus {
            color: #fff;
        }

        .btn, .navbar .navbar-nav>a.btn {
            border-width: 2px;
            font-weight: 400;
            font-size: .8571em;
            line-height: 1.35em;
            border: none;
            border-radius: .1875rem;
            padding: 11px 22px;
            cursor: pointer;
            background-color: #ccc;
            color: #fff;
        }
     
        .btn-round {
            border-width: 1px;
            border-radius: 30px !important;
            padding: 11px 23px;
        }

        .btn-primary {
            background: #00cfd1;
        }

        .btn-primary:hover {
            background: #00cfd1;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.15);
        }

        .btn-default {
            background: #ddd;
            color:#636b6f;
        }

        .nav-tabs {
            border-bottom: 0px;
        }

        .nav-tabs>li>a, .nav-tabs>li>a:focus, .nav-tabs>li>a:hover {
            color: #888;
            background-color: #fff;
            border: 0px;
        }

        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
            color: #888;
            background-color: #fff;
            border: 1px solid #00cfd1;
            border-radius: 30px;
        }

        /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */

        .wrapper {
            display: flex;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #fff;
            color: #888;
            transition: all 0.3s;
        }

        #sidebar.active {
            min-width: 80px;
            max-width: 80px;
            text-align: center;
        }

        #sidebar.active .sidebar-header h3,
        #sidebar.active .CTAs {
            display: none;
        }

        #sidebar.active .sidebar-header strong {
            display: block;
        }

        #sidebar ul li a {
            text-align: left;
            text-decoration: none;
        }

        #sidebar.active ul li a {
            padding: 20px 10px;
            text-align: center;
            font-size: 0.85em;
        }

        #sidebar.active ul li a i {
            margin-right: 0;
            display: block;
            font-size: 1.8em;
            margin-bottom: 5px;
        }

        #sidebar.active ul ul a {
            padding: 10px !important;
        }

        #sidebar.active .dropdown-toggle::after {
            top: auto;
            bottom: 10px;
            right: 50%;
            -webkit-transform: translateX(50%);
            -ms-transform: translateX(50%);
            transform: translateX(50%);
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #fff;
        }

        #sidebar .sidebar-header strong {
            display: none;
            font-size: 1.8em;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #ccc;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
            color:#888;
        }

        #sidebar ul li a:hover {
            color: #fff;
            background: #01d8da;
        }

        #sidebar ul li a i {
            margin-right: 10px;
        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background: #01d8da;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }

        ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #fff;
        }


        /* ---------------------------------------------------
            CONTENT STYLE
        ----------------------------------------------------- */

        #content {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* ---------------------------------------------------
            MEDIAQUERIES
        ----------------------------------------------------- */

        @media (max-width: 768px) {
            #sidebar {
                min-width: 80px;
                max-width: 80px;
                text-align: center;
                margin-left: -80px !important;
            }
            .dropdown-toggle::after {
                top: auto;
                bottom: 10px;
                right: 50%;
                -webkit-transform: translateX(50%);
                -ms-transform: translateX(50%);
                transform: translateX(50%);
            }
            #sidebar.active {
                margin-left: 0 !important;
            }
            #sidebar .sidebar-header h3,
            #sidebar .CTAs {
                display: none;
            }
            #sidebar .sidebar-header strong {
                display: block;
            }
            #sidebar ul li a {
                padding: 20px 10px;
            }
            #sidebar ul li a span {
                font-size: 0.85em;
            }
            #sidebar ul li a i {
                margin-right: 0;
                display: block;
            }
            #sidebar ul ul a {
                padding: 10px !important;
            }
            #sidebar ul li a i {
                font-size: 1.3em;
            }
            #sidebar {
                margin-left: 0;
            }
        }
    </style>

    <script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>

    @yield('page_level_script')
    @yield('page_level_css')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="text-center">Clinic Solutions</h3>
                <strong>CS</strong>
            </div>

            <ul class="list-unstyled components">
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><a href="{{ url('patient') }}"><i class="fa fa-notes-medical"></i> Patients</a></li>
                    <li><a href="{{ url('calendar') }}"><i class="fa fa-calendar"></i> Calendar</a></li>
                    <li><a href="{{ url('service') }}"><i class="fa fa-user-md"></i> Services</a></li>
                    
                    <li>
                        <a href="#profileSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-home"></i>
                            Profile
                        </a>
                        <ul class="collapse list-unstyled" id="profileSubmenu">
                            <li>
                                <a href="{{ url('business_information') }}">Business Information</a>
                            </li>
                            <li>
                                <a href="{{ url('change_password') }}">Change Password</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
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

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <i class="fa fa-clinic-medical"></i> 
                        @guest
                        {{ config('app.name', 'Laravel') }}
                        @else
                        {{ Auth::user()->client->name }}
                        @endguest
                    </a>

                    
                </div>

            </nav>

            <div style="height:100px;width:100%;position:absolute;left:0px;top:50px;z-index: -1;background-color: #01d8da;"></div>
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
