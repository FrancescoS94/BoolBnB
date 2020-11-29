{{-- {{-- PAGINA USER LOGGATO --}}
@extends('layouts.admin')

@section('aside')
    {{-- Sidebar --}}
      <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2 aside">

        {{-- Nome e immagine Avatar --}}
        <div class="utente-dash text-center">
          <div class="navbar-toggler" style="position:relative" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              @if(Auth::check())
                  {{-- <img id="avatar-img" class="rounded-circle" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. Auth::user()->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo"> --}}
                  <p style="position: absolute; top:50%; left:50%; transform: translate(-50%, -50%); font-size:30px;" id="name"> Ciao {{Auth::user()->name}}</p>
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

<style>



    #avatar-img{
        display: none;
    }

    .loader_bg{
      position: fixed;
      z-index: 999999;
      background: #ffffff;
      width: 100%;
      height: 100%;
    }

    .loader{
        border: 0 solid transparent;
        border-radius: 50%;
        width: 150px;
        height: 150px;
        position: absolute;
        top: calc(50vh - 75px);
        left: calc(50vw - 75px);
    }

    .loader:before, .loader:after{
        content: '';
        border: 1em solid #133b55;
        border-radius: 50%;
        width: inherit;
        height: inherit;
        position: absolute;
        top: 0;
        left: 0;
        animation: loader 2s linear infinite;
        opacity: 0;
    }

    .loader::before{
        animation-delay: .5s;
    }

    @keyframes loader{
        0%{
            transform: scale(0);
            opacity: 0;
        }
        50%{
            opacity: 1;
        }
        100%{
            transform: scale(1);
            opacity: 0;
        }
    }

    .bg-white{
        background-color: #4ea9be !important;
    }

    .navbar-brand.logo,input{
        color: white !important;
    }

    /* body{
        background-image: url('../image/phone_maintenance.png');
    } */
</style>

<div class="loader_bg">
    <div class="loader"></div>
</div>

{{-- PROFILE --}}
<div class="container vh">
    <img src="{{asset('image/phone_maintenance.png')}}" alt="">
    <div class="row justify-content-center profile">
        <div class="col-md-10 col-lg-9 d-flex justify-content-center jumbotron mt-3">
            {{-- esito dell'operazione  --}}
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="text-center profile-date">
                {{-- Ciao {{ Auth::user()->name }} qui puoi aggiornare il tuo profilo --}}
                {{-- Condizione logica sulla presenza o meno di un immagine di profilo, di default c'è un immagine --}}
                <img class="rounded-circle" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. $user->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="Immagine del profilo">
                <h2 class="profile-title">{{$user->name}} {{$user->lastname}}</h2>
                <p class="profile-email pb-3">{{$user->email}}</p>
                <div class="row date">
                    <div class="text-right col-6 pt-3">
                        <p>Nome:</p>
                        <p>Cognome:</p>
                        <p>Data di nascita:</p>
                        <p>email:</p>
                        <p>Appartamenti:</p>
                        <p>Creazione profilo:</p>
                        <p>Ultima modifica:</p>
                    </div>
                    <div class="text-left col-6 pt-3">
                        <p>{{$user->name}}</p>
                        <p>{{$user->lastname}}</p>
                        <p>{{ Carbon\Carbon::parse($user->date_of_birth)->settings(['toStringFormat' => 'j F Y', ]) }}</p>
                        <p>{{$user->email}}</p>
                        <p>
                            @if($user->status == 0)
                                No
                            @elseif($user->status == 1)
                                Sì
                            @endif
                        </p>
                        <p>{{ Carbon\Carbon::parse($user->created_at)->settings(['toStringFormat' => 'j F Y', ]) }}</p>
                        <p>{{ Carbon\Carbon::parse($user->updated_at)->settings(['toStringFormat' => 'j F Y', ]) }}</p>
                    </div>
                </div>
                {{--  rotta show, al momento inutile, NON cancellare!
                <a href="{{route('admin.users.update',  $user->id)}}"><button type="button" class="btn btn-success"></button></a> --}}
                <div class="d-flex justify-content-center">
                    <a class="btn-blu text-decoration-none mr-2 mt-3" href="{{route('admin.users.edit', $user->id)}}" role="button">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Aggiungi informazioni' : 'Modifica'}}</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-red ml-2 mt-3" type="submit">Cancella</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function(){
            $('.loader_bg').fadeToggle();
            $('#avatar-img').show();
        }, 2000);
    </script>
</div>
@endsection
