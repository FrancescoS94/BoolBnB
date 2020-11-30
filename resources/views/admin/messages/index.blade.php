{{-- TUTTI I MESSAGGI RICEVUTI DELL'UTENTE LOGGATO --}}
{{-- @dd(count($messagesReceived)) --}}
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

<div class="jumbotron lista-messaggi">
  <h1>MESSAGGI RICEVUTI</h1>

  @if(count($messagesReceived) == 0)
      <p>Non hai ancora ricevuto nessun messaggio.</p>
  @elseif(count($messagesReceived) > 0)
  @endif

  @foreach($messagesReceived as $message)
  <div class="row d-flex justify-content-center dettagli-messaggio
  @if($message['viewed'] == 0)
  font-weight-bold
  @endif
  ">

    <div class="col-md-4 col-lg-4 col-xl-4  left-dettagli">
      <p><strong>Data di ricezione: </strong> {{ Carbon\Carbon::parse($message['created_at'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</p>
      <p><strong>Da: </strong> {{ $message['name'] }} {{ $message['lastname'] }}</p>
    </div>

    <div class="col-md-4 col-lg-4 col-xl-4 center-dettagli">
      <p><strong>Appartamento: </strong>{{ $message['flat_id'] }}</p>
      <p><strong>Mail: </strong> {{ $message['email'] }}</p>
    </div>

    <div class="col-md-4 col-lg-4 col-xl-4 my-auto  buttons-dettagli">
      <span>
        <a href="{{ route('admin.messages.show', $message['id']) }}"><button class="btn-blu" type="button" name="button">Leggi</button> </a>
      </span>
      <span>
        <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn-red" type="submit" name="button">Cancella</button>
        </form>
      </span>
    </div>

  </div>  {{--chiusura row dettagli-messaggio--}}
  @endforeach

</div>  {{--chiusura container-fluid lista-messaggi --}}

@endsection
