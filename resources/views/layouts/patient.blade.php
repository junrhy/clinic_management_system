<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Patient Portal</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>

    @yield('page_level_script')
    @yield('page_level_css')

    <style type="text/css">
        .navbar-primary {
            background-color: #018d8e;
        }

        .panel-primary {
            border-color: #018d8e;
        }

        .panel-primary > .panel-heading {
            color: #fff;
            background-color: #018d8e;
            border-color: #018d8e;
        }

        .btn-primary {
            background-color: #018d8e;
        }

        .header-section {
            border-bottom:2px dotted #018d8e;
            padding:10px;
            color:#018d8e;
            font-weight: bold;
        }

        .navbar-brand a, .navbar-brand a:hover, .navbar-brand a:active, .navbar-brand a:visited {
            color: #FFFFFF;   
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-primary navbar-static-top">

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="navbar-brand">
                                <a href="/patient_view"><i class="fa fa-clinic-medical"></i> {{ auth()->user()->client->name }}</a>
                            </span>
                        </div>
                        <div class="col-md-6 text-right">
                            <a class="btn btn-round btn-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" style="margin-top: 6px;">
                                <i class="fas fa-power-off"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('page_level_footer_script')
</body>
</html>