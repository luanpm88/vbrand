<!doctype html>
<html lang="en">
    <head>
        <title>@yield('title')</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}"></script> 

        <!-- Google icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- Popup -->
        <link href="{{ asset('client/css/popup.css') }}" rel="stylesheet">
        <script src="{{ asset('client/js/popup.js') }}"></script> 

        <!-- DataList -->
        <link href="{{ asset('client/css/datalist.css') }}" rel="stylesheet">
        <script src="{{ asset('client/js/datalist.js') }}"></script> 

        <!-- Main -->
        <link href="{{ asset('client/css/main.css') }}" rel="stylesheet">
        <script src="{{ asset('client/js/main.js') }}"></script>
        
        <link href="{{ asset('client/css/message.css') }}" rel="stylesheet">
    </head>
    <body>
        @yield('content')
    </body>
</html>