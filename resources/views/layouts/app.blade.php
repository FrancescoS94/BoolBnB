<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Incluso Font-Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Boolbnb') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('glider.css')}}">


    <!-- aggiunta 18-11 tomtom -->
    <meta name='viewport' content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no' />
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps.css'>
    <link rel='stylesheet' type='text/css' href='{{asset('css/index.css')}}'/>
    <link rel='stylesheet' type='text/css'
        href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.24.2//SearchBox.css' />
    <link rel='stylesheet' type='text/css'
        href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/css-styles/poi.css' />

    @yield('head')
    @yield('script-in-head')

    {{-- SCRIPT DI ALGOLIA --}}
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
</head>
<body>
    <header>
        @include('template.header')
    </header>
        <main>
            @yield('content')
        </main>

    <footer>
        @include('template.footer')
    </footer>
@yield('script-in-body')
</body>
</html>
