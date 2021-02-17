<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Clinic Management Software</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/e3497de5a4.js" crossorigin="anonymous"></script>

    <style type="text/css">
      body {
        background: #FFFFFF;
      }

      .panel-primary {
        border-color: #018d8e;
      }

      .panel-primary > .panel-heading {
        color: #fff;
        background-color: #018d8e;
        border-color: #018d8e;
      }

      .btn-login {
        background-color: #018d8e;
        border-radius: 5px;
        color: #FFFFFF;
      }
    </style>
<body class="">
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>