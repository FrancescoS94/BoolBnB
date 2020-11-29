{{-- SHOW DEL SINGOLO MESSAGGIO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')

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

<div class="container show-messaggio">

  <div class="row messaggio d-flex justify-content-center">
    <div class="jumbotron col-md-10 col-lg-10 col-xl-10 ">

      <div class="row titolo-messaggio">
        <h1>Messaggio ricevuto</h1>
      </div>

      <div class="row">
        <div class="dettagli">
          <ul>
            <li> <strong>Data e ora di ricezione</strong> {{ Carbon\Carbon::parse($message['created_at'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</li>
            <li> <strong>Nome</strong> {{ $message['name'] }}</li>
            <li> <strong>Cognome</strong> {{ $message['lastname'] }}</li>
            <li> <strong>Email</strong> {{ $message['email'] }}</li>
            <li> <strong>Appartamento</strong> {{ $message['flat_id'] }}</li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="testo-messaggio">
          <p>{{ $message['request'] }}</p>
        </div>
      </div>


        <div class="lettura row">
          @if($message['viewed'] == 0)
            <form action="{{ route('admin.messages.update', $message['id']) }}" method="post">
                @csrf
                @method('PATCH')
                <input class="btn-blu" type="submit" value="Segna come letto">
            </form>

          @else
            <form action="{{ route('admin.messages.update', $message['id']) }}" method="post">
                @csrf
                @method('PATCH')
                <input class="btn-blu" type="submit" value="Segna come da leggere">
            </form>

          @endif
            <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
                @csrf
                @method('DELETE')
                <input class="btn-red" type="submit" value="Cancella messaggio">
            </form>
        </div>



    </div>   {{-- fine Jumbo --}}

  </div>

</div>


{{--
<div class="container show-messaggio">

  <div class="container row messaggio-ricevuto ">

     {{-- <div class="navigazione">
      <a href="{{ route('admin.messages.index') }}">Torna a tutti i messaggi</a>
    </div>

    <h1>Messaggio ricevuto</h1>
    <div class="dettagli">
      <ul>
        <li> <strong>Data e ora di ricezione</strong> {{ Carbon\Carbon::parse($message['created_at'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</li>
        <li> <strong>Nome</strong> {{ $message['name'] }}</li>
        <li> <strong>Cognome</strong> {{ $message['lastname'] }}</li>
        <li> <strong>Email</strong> {{ $message['email'] }}</li>
        <li> <strong>Appartamento</strong> {{ $message['flat_id'] }}</li>
      </ul>
    </div>

    <div class="testo-messaggio">
      <p>{{ $message['request'] }}</p>
    </div>

    <div class="lettura">
      @if($message['viewed'] == 0)
        <form action="{{ route('admin.messages.update', $message['id']) }}" method="post">
            @csrf
            @method('PATCH')
            <input class="btn btn-dark" type="submit" value="Segna come letto">
        </form>

      @else
        <form action="{{ route('admin.messages.update', $message['id']) }}" method="post">
            @csrf
            @method('PATCH')
            <input class="btn-blu" type="submit" value="Segna come da leggere">
        </form>

      @endif
        <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn-red" type="submit" value="Cancella messaggio">
        </form>

    </div>


  </div>

</div>--}}
@endsection
