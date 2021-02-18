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
        #logo {
            margin: 15px 0px;
        }

        body {
            background-color: #01d8da;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="">
                    <div style="float:left;">
                        <a class="logo" href="{{ url('/home') }}">
                            @if (auth()->user()->type !='admin' && auth()->user()->client->logo != "")
                                @if(env('FILESYSTEM_DRIVER') == 'spaces')
                                <img src="{{ asset('https://file-server1.sfo2.digitaloceanspaces.com/' . auth()->user()->client->logo) }}" id="logo" class="" style="margin: 30px 3px 3px 3px;height:75px;width: 97%;">
                                @endif

                                @if(env('FILESYSTEM_DRIVER') == 'public')
                                <img src="{{ asset('storage/' . auth()->user()->client->logo) }}" id="logo" class="" style="margin: 30px 3px 3px 3px;height:60px;width: 97%;">
                                @endif
                            @else
                                <img id="logo" src="/img/brand/bluewhalecms.png" style="height: 60px;">
                            @endif
                        </a>
                    </div>
                    <div align="right">
                        <a href="/home">Back</a> | 
                        <a class="" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
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