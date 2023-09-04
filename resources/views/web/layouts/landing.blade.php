<!DOCTYPE html>
<html lang="en">
<head>
    @include('web.includes.landing._head')
</head>
<body id="page-top">
    @include('web.includes.landing._navigation')
    @include('web.includes.landing._hero')
    {{-- @include('web.includes.landing._about') --}}
    @yield('content')
    @include('web.includes.landing._footer')
    @include('web.includes.landing._script')
</body>
</html>