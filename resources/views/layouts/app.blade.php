<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name'), 'LBMHS ADMIN GUI' }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    @yield('third_party_stylesheets')
    @stack('page_css')

</head>

<body class="c-app">
@include('partials.load')
@include('layouts.sidebar')
<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed">
        @include('layouts.header')
    </header>

    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    @include('partials.alerts')
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <footer class="c-footer">
        <div><a href="#">LBMHS ADMIN v2.0</a> © 2021 Mark Lucas.</div>
        <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
    </footer>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

@yield('third_party_scripts')

<script type="text/javascript">
jQuery(document).ready(function(){
    $('.loader_bg').hide();

    $('.loadMe').click(function() {
        $('.loader_bg').show();
    });
});
</script>

</body>
</html>
