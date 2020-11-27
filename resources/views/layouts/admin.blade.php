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
    @yield('script-in-head')
    @yield('head')

</head>
<body>
  <div class="container-fluid">
    <div class="row">

      {{-- Sidebar --}}
      <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2 aside">

        {{-- Nome e immagine Avatar --}}
        <div class="utente-dash text-center">
          <div class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              @if(Auth::check())
                  <img id="avatar-img" class="rounded-circle " src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. Auth::user()->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo">
                  <p id="name"> {{Auth::user()->name}}</p>
              @endif
          </div>
        </div>

        {{-- Link Sidebar--}}
        <div class="links-box">

            <a href="{{ route('home') }}"> <span><i class="fas fa-home"></i></span><span class="link-name">Homepage</span></a>

            <a href="{{ route('admin.users.index') }}"> <span><i class="fas fa-users-cog"></i></span><span class="link-name">Profilo</span></a>

            <a href="{{ route('admin.flats.index') }}"><span><i class="fas fa-house-user"></i></span><span class="link-name">Appartamenti</span></a>

            <a href="{{ route('admin.messages.index') }}"> <span><i class="fas fa-envelope"></i></span><span class="link-name">Messaggi</span></a>

            <a href="{{ route('admin.payments.index') }}"> <span><i class="fas fa-credit-card"></i></span><span class="link-name">Pagamenti</span></a>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <span><i class="fas fa-sign-out-alt"></i></span>
              <span class="link-name ">Logout</span>
            </a>
            {{-- chiamata post --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>

      </div>

      {{-- Lato dx layout, contenuto--}}
      <div class="col-9 col-sm-9 col-md-10 col-lg-10 col-xl-10 lay-dx">
        <main>
          @yield('content')
        </main>
      </div>

    </div>
  </div>


    @yield('script-in-body')
</body>
</html>
