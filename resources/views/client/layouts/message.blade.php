<!doctype html>
<html lang="en">
    <head>
        <title>@yield('title')</title>

        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script> 

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>


        <!-- Google icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- Popup -->
        <link href="{{ asset('client/css/popup.css') }}" rel="stylesheet">
        <script src="{{ asset('client/js/popup.js') }}"></script> 

        <!-- DataList -->
        <link href="{{ asset('client/css/datalist.css') }}" rel="stylesheet">
        <script src="{{ asset('client/js/datalist.js') }}"></script> 

        <link href="{{ asset('client/css/main.css') }}" rel="stylesheet">
        <script src="{{ asset('client/js/main.js') }}"></script> 
    </head>
    <body>
        @yield('content')
    </body>
</html>