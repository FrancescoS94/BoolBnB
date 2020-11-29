{{-- TUTTI I MESSAGGI RICEVUTI DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

@section('head')
    {{-- aggiunta 18-11-20 tomtom --}}
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps-web.min.js'></script>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/services/services-web.min.js'></script>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.24.2//SearchBox-web.js'></script>
    <script type='text/javascript' src='{{ asset('js/search-marker.js')}}' ></script>
    <script type='text/javascript' src='{{ asset('js/search-results-parser.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/search-markers-manager.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/info-hint.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/mobile-or-tablet.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/results-manager.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/side-panel.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/dom-helpers.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/formatters.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/address-create-tomtom.js')}}'></script>
@endsection

@section('aside')
    {{-- Sidebar --}}
      <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2 aside">

        {{-- Nome e immagine Avatar --}}
        <div class="utente-dash text-center">
          <div class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              @if(Auth::check())
                  <img id="avatar-img" class="rounded-circle" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. Auth::user()->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo">
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
@endsection

@section('content')
<div class="container vh">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
               
                {{-- controllo errori --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <h2 class="pt-5">Dove si trova l'appartamento che vuoi inserire?</h2>
                {{-- aggiunta 18-11-20 tomtom --}}
                <div class='map-view my-3'>
                    <div class='tt-side-panel' style="height: 40vh;">
                        <header class='tt-side-panel__header'>
                        </header>
                        <div class='tt-tabs js-tabs'>
                            <div class='tt-tabs__panel'>
                                <div class='js-results' hidden='hidden'></div>
                                <div class='js-results-loader' hidden='hidden'>
                                    <div class='loader-center'><span class='loader'></span></div>
                                </div>
                                <div class='tt-tabs__placeholder js-results-placeholder'></div>
                            </div>
                        </div>
                    </div>
                    <div id='map' class='full-map' style="height: 40vh;"></div>
                </div> {{-- fine tomtom --}}

                <div>
                    <a  class="btn-blu text-decoration-none" href="{{ route('admin.flats.create') }}">Invia</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
