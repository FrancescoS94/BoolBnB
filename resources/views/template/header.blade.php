<nav class="container-fluid navbar navbar-light fixed-top shadow">
    <a class="navbar-brand logo" href="{{ url('/') }}">
        <img src="{{ asset('storage/images/logo-rossoblu.png')}}" alt="Boolbnb">
    </a>

    {{-- <div class="search">
        <input class="search-text" type="text" name="" placeholder="Inizia la ricerca">
        <a href="#" class="search-btn">
            <i class="fa fa-search"></i>
        </a>
    </div> --}}

    <form class="search" action="{{route('flats.index')}}" method="GET">
        <input type="search" id="city" class="search-text form-control" placeholder="Dove sogni di andare?" />
        {{-- NASCOSTO --}}<input id="query_lat" type="text" name="query_lat" hidden>
        {{-- NASCOSTO --}}<input id="query_lng" type="text" name="query_lng" hidden>
        <button class="search-btn" id="clickMe"><i class="fa fa-search"></i></button>
    </form>

    @guest
    <!-- Authentication Links -->
    <div class="navbar-nav guest">
        <a class="nav-link hov" href="{{ route('login') }}">{{ __('Accedi') }}</a>
        @if (Route::has('register'))
        <a class="nav-link hov" href="{{ route('register') }}">{{ __('Registrati') }}</a>
        @endif
    </div>
    @else
    <!-- Bottone e menu a tendina per users -->
    <div class="nav-item dropdown">
        <div class="nav-link" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{-- se l'utente è loggato entro nella condizione if --}}
            @if(Auth::check())
                Ciao {{Auth::user()->name}}
                {{-- Condizione logica sulla presenza o meno di un immagine di profilo, di default c'è un immagine --}}
                <img id="avatar-img" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. Auth::user()->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo">
                {{-- <img id="avatar-img" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. $user->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo"> --}}
            @endif
        </div>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @if(Auth::check()) {{-- Condizione logican se l'utente è loggato vedrà questo elemento --}}
                <a class="dropdown-item hov2" href="{{ route('admin.users.index') }}">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Completa il tuo profilo' : 'Gestisci il tuo profilo' }}
            @endif

            <a class="dropdown-item hov2" href="{{ route('admin.flats.index') }}">{{ __('Gestisci appartamenti') }}</a>
            <a class="dropdown-item hov2" href="{{ route('admin.messages.index') }}">{{ __('Messaggi ricevuti') }}</a>
            <a class="dropdown-item hov2" href="{{ route('admin.payments.index') }}">{{ __('Pagamenti effettuati') }}</a>

            <a class="dropdown-item hov2" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                <!-- Aggiunta link -->
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    @endguest
</nav>

{{-- SCRIPT DI ALGOLIA --}}
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>

<script>

    (function() {
        var list=[];
        var placesAutocomplete = places({
            appId: 'plHDPE6IE51U',
            apiKey: '13f35e1233e3a7aedf08241d21430869',
            container: document.querySelector('#city'),
            templates: {
                value: function(suggestion){
                    list.push(suggestion);
                    return suggestion.name;
                }
            }
        }).configure({
            type: 'city',
            aroundLatLngViaIP: false,
        });

        document.getElementById('clickMe').addEventListener('click', function(){
            var city =  document.getElementById('city').value;
            for(var i=0; i<list.length; i++){
                if(list[i]['name'] === city){
                    var lat = list[i]['latlng']['lat'];
                    var lng = list[i]['latlng']['lng'];
                    var querylat = document.getElementById('query_lat').value =  lat;
                    var querylng = document.getElementById('query_lng').value =  lng;
                }
            }
        });
    })();

</script>