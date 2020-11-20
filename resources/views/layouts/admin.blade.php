{{-- LAYOUT PER GLI ADMIN--}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Incluso Font-Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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

</head>
<body>

  <div class="container-fluid">
    <div class="row">
      <div class="col-2 aside">
        <a href="{{ route('admin.users.index') }}"> <span><i class="fas fa-users-cog"></i></span>Gestisci il tuo profilo</a>
        <a href="{{ route('admin.flats.index') }}"><span><i class="fas fa-house-user"></i></span>Gestisci Appartamenti</a>
        <a href="{{ route('admin.messages.index') }}"> <span><i class="fas fa-envelope"></i></span>Messaggi Ricevuti</a>
        <a href="{{ route('admin.payments.index') }}"> <span><i class="fas fa-credit-card"></i></span>Pagamenti Effettuati</a>
        <a href="{{ route('logout') }}"> <span><i class="fas fa-sign-out-alt"></i></span>Logout</a>
      </div>

      <div class=" col-10 main">
        <main>
          @yield('content')
        </main>
      </div>
    </div>
  </div>

</body>
</html>
