<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('includes.head')
</head>
<body>
    <div id="main-panel">
        @yield('content')
    </div>
</body>
</html>
