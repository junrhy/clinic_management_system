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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background-color: #01d8da;">

                <div class="container">
                    <div class="navbar-header">
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-clinic-medical"></i> {{ auth()->user()->client->name }}
                        </a>
                    </div>
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

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('page_level_footer_script')
</body>
</html>