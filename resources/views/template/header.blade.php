<section class="bg-white fixed-top">
<nav class="navbar navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand logo" href="{{ url('/') }}">
            {{-- {{ config('app.name', 'Laravel') }} --}}
            <strong>
                Boolbnb
            </strong>
        </a>

        <div class="search">
            <input class="search-text" type="text" name="" placeholder="Inizia la ricerca">
            <a href="#" class="search-btn">
                <i class="fa fa-search"></i>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
            {{-- se l'utente è loggato entro nella condizione if --}}
            @if(Auth::check())

                Ciao {{Auth::user()->name}}
                {{-- Condizione logica sulla presenza o meno di un immagine di profilo, di default c'è un immagine --}}
                <img style="width: 100px" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. $user->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo">
            @endif

        </button>

        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            {{-- <ul class="navbar-nav mr-auto">

            </ul> --}}
            

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav dropdown-menu dropdown-menu-right mr-4">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link hov" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link hov" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown admin-item">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle pl-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                            <a class="nav-link hov2" href="{{ route('admin.users.index') }}">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Completa il tuo profilo' : 'Gestisci il tuo profilo' }}
                            {{-- <a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('Completa il tuo profilo') }}</a> --}}
                            <a class="nav-link hov2" href="{{ route('admin.flats.index') }}">{{ __('Gestisci appartamenti') }}</a>
                            <a class="nav-link hov2" href="{{ route('admin.messages.index') }}">{{ __('Messaggi ricevuti') }}</a>

                            <a class="nav-link hov2" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                <!-- Aggiunta link -->
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
</section>
