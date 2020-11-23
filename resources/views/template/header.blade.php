<nav class="container-fluid navbar navbar-light fixed-top shadow">
    <a class="navbar-brand logo" href="{{ url('/') }}">
        <img src="{{ asset('storage/images/logo-rossoblu.png')}}" alt="Boolbnb">
    </a>

    <div class="search">
        <input class="search-text" type="text" name="" placeholder="Inizia la ricerca">
        <a href="#" class="search-btn">
            <i class="fa fa-search"></i>
        </a>
    </div>


    <!-- Right Side Of Navbar -->
    <!-- Authentication Links -->
    @guest
        <div class="navbar-nav guest">
            <a class="nav-link hov" href="{{ route('login') }}">{{ __('Accedi') }}</a>
            @if (Route::has('register'))
            <a class="nav-link hov" href="{{ route('register') }}">{{ __('Registrati') }}</a>
            @endif
        </div>
    @else
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            {{-- se l'utente è loggato entro nella condizione if --}}
            @if(Auth::check())
                Ciao {{Auth::user()->name}}
                {{-- Condizione logica sulla presenza o meno di un immagine di profilo, di default c'è un immagine --}}
                <img id="avatar-img" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. Auth::user()->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo">
                {{-- <img id="avatar-img" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. $user->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo"> --}}
            @endif
        </button>

            <!-- Right Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav dropdown-menu dropdown-menu-right mr-4">
                <li class="nav-item dropdown admin-item">
                    @if(Auth::check()) {{-- Condizione logican se l'utente è loggato vedrà questo elemento --}}
                        <a class="nav-link hov2" href="{{ route('admin.users.index') }}">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Completa il tuo profilo' : 'Gestisci il tuo profilo' }}
                    @endif

                    <a class="nav-link hov2" href="{{ route('admin.flats.index') }}">{{ __('Gestisci appartamenti') }}</a>
                    <a class="nav-link hov2" href="{{ route('admin.messages.index') }}">{{ __('Messaggi ricevuti') }}</a>
                    <a class="nav-link hov2" href="{{ route('admin.payments.index') }}">{{ __('Pagamenti effettuati') }}</a>

                    <a class="nav-link hov2" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        <!-- Aggiunta link -->
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    @endguest
</nav>
