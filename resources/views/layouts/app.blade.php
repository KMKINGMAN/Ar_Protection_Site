<!doctype html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("css/font-awesome.min.css") }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

    <style>
        .waveTop {
            background: url("{{ asset('images/wave-top.png') }}");
        }

        .waveMiddle {
            background: url("{{ asset('images/wave-mid.png') }}");
        }

        .waveBottom {
            background: url("{{ asset('images/wave-bot.png') }}");
        }
    </style>
    <link href="{{ asset("css/style.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("css/cutsom.css") }}" rel="stylesheet" type="text/css" />
    @yield('css')
</head>
<body>
    <div id="app">
        <div id="particles-js"></div>
        @yield('content')
    </div>
    @include('partials.footer')
    @yield('js')
</body>
</html>
