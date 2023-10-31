<!DOCTYPE html>
<html lang="en">

<head>
    @include('web.includes.landing._head')
    @stack('extra-styles')
</head>

<body id="page-top" style="background-color: rgba(238, 238, 238, 0.8);">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-light text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{ asset('landing/assets/img/logo.webp') }}"></a>
        </div>
    </nav>
    @include('web.includes.landing._hero')
    {{-- @include('web.includes.landing._about') --}}
    @yield('content')
    {{-- @include('web.includes.landing._footer') --}}
    @include('web.includes.landing._script')
</body>

</html>
