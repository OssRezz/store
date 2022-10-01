<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="{{ asset('assets/images/sinlimite.jpg') }}" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>
@yield('cdn')

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

<!-- Scripts -->
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
<script type="text/javascript" src="{{ asset('jquery-3.6.1.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}">
<script type="text/javascript" src="{{ asset('assets/datatable/datatables.min.js') }}"></script>

<link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<link href="{{ asset('assets/fontawesome/css/fontawesome.css') }}" rel="stylesheet">
<link href="{{ asset('assets/fontawesome/css/brands.css') }}" rel="stylesheet">
<link href="{{ asset('assets/fontawesome/css/solid.css') }}" rel="stylesheet">

<head>
</head>

<body class="scrolly">
    <div class="container toasts" id="toats"></div>
    <div id="respuesta"></div>
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('components.sidebard')

        <div id="content" class="bg-light">
            <!-- Menú del top -->
            @include('components.navbar')

            <div class="container-fluid px-4">
                @yield('content')
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/js/hbMenu.js') }}"></script>
</body>

</html>
