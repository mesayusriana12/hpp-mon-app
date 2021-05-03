<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HPP-Monitor | @yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/all.min.css')}}">

    {{-- jquery --}}
    <script src="{{asset('js/jquery.slim.js')}}" type="text/javascript"></script>

    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="c-app">
@include('sweetalert::alert')
@include('layouts.sidebar')

<div class="c-wrapper">
    <header class="c-header c-header-dark c-header-fixed" style="background: #303C54; border-bottom: 1px solid #303C54">
        @include('layouts.header')
    </header>

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
            @yield('content')
                </div>
            </div>
        </main>
    </div>

    <footer class="c-footer">
        <div>Hybrid Power Plant Monitoring App © 2021</div>
        <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
    </footer>
</div>

<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.perfect-scrollbar.js') }}"></script>

@yield('third_party_scripts')

@stack('page_scripts')
</body>
</html>
