<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>

    <!-- Styles -->
    <style type="text/css">
 
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
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            

            <div class="sidebar-header">
                <h3 class="text-center">
                    <i class="fa fa-user"></i> 
                    <br>
                    <small style="color: #01d8da;">Admin Panel</small>
                </h3>
            </div>
                               

            <ul class="list-unstyled components">
                <li class="">
                    <a href="{{ url('admin') }}"><i class="fa fa-chalkboard"></i> Dashboard</a>
                </li>

                <li class="">
                    <a href="{{ url('admin/clients') }}"><i class="fa fa-users"></i> Clients</a>
                </li>

                <li class="">
                    <a href="{{ url('admin/subscriptions') }}"><i class="fa fa-gear"></i> Subscriptions</a>
                </li>

                <li class="">
                    <a href="{{ url('admin/billings') }}">&nbsp;<i class="fa fa-file-alt"></i> Billings</a>
                </li>

                <li class="">
                    <a href="{{ url('admin/payments') }}">&nbsp;<i class="fa fa-file-alt"></i> Payments</a>
                </li>

                <li class="">
                    <a href="{{ url('admin/domains') }}">&nbsp;<i class="fa fa-globe"></i> Domains</a>
                </li>

                <li class="">
                    <a href="{{ url('/tickets-admin') }}">&nbsp;<i class="fa fa-question"></i> Tickets</a>
                </li>

                <li class="">
                    <a href="{{ url('admin/settings') }}">&nbsp;<i class="fa fa-gear"></i> Settings</a>
                </li>

                <li class="">
                    <a href="#profileSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-user-cog"></i>
                        Account
                    </a>
                    <ul class="collapse list-unstyled" id="profileSubmenu">
                        <li>
                            <a href="{{ url('admin/change_password') }}">Change Password</a>
                        </li>

                       
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

                    </div>
                </div>
            </nav>

            <div id="below-nav-design" style="height:200px;position:absolute;left:0px;top:50px;z-index: -1;background-color: #01d8da;"></div>

            @yield('content')
        </div>
    </div>
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
