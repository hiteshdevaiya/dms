<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light" data-sidebar-image="none">



    <head>

    <base href="{{ url('/') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8" />

    <title>SGVP | Digi Campus</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta content="Themesbrand" name="author" />

    <!-- App favicon -->

    <link rel="shortcut icon" href="{{ url('public/images/logo.svg')}}">

        @include('layouts.head-css')

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

        <script src="{{ url('public/js/dms.min.js')}}"></script>

        {{-- @vite('resources/js/admin.js') --}}

  </head>

    @yield('body')

    @yield('content')

    @include('layouts.vendor-scripts')

    </body>

</html>

