<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bluewhale - Manage your Clinic Online</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>

    <style type="text/css">
        body {
            background-color: #01d8da;
        }

        .navbar-custom {
          height: 90px;
          vertical-align: middle;
        }

        .m-t-20 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-custom">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        @if (auth()->user()->type !='admin' && auth()->user()->client->logo != "")

                            @if(env('FILESYSTEM_DRIVER') == 'spaces')
                            <img src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/' . auth()->user()->client->logo) }}" height="60">
                            @endif

                            @if(env('FILESYSTEM_DRIVER') == 'public')
                            <img src="{{ asset('storage/' . auth()->user()->client->logo) }}" height="60">
                            @endif
                        @else
                            <img src="/img/brand/bluewhalecms.png" height="60">
                        @endif
                    </a>
                </div>

                <ul class="nav navbar-nav navbar-right m-t-20">
                    <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>

            </div>
        </nav>
        <br>

        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('footer')
</body>
</html>