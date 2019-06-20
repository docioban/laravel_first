<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <script>
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });
    </script>
    <style>
        .block_post {
            background-color: #636b6f;
            padding: 15px;
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
    <div id="app">
        @include('inc.nav_bar')

        <main class="py-4 container">
            @include('inc.message')
            @yield('content')
        </main>
    </div>
</body>
</html>
