{{-- @dd(count($messagesReceived)) --}}
{{-- TUTTI I MESSAGGI RICEVUTI DELL'UTENTE LOGGATO --}}
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
<div class="container vh">
  <h1>Tutti i messaggi ricevuti</h1>
  @if(count($messagesReceived) == 0)
      <p>Non hai ancora ricevuto nessun messaggio.</p>
  @elseif(count($messagesReceived) > 0)
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Data e ora di ricezione</th>
            <th scope="col">Nome</th>
            <th scope="col">Cognome</th>
            <th scope="col">Email</th>
            <th scope="col">Appartamento</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($messagesReceived as $message)
            <tr
            @if($message['viewed'] == 0)
              class="font-weight-bold"
            @endif
            >
              <td>{{ Carbon\Carbon::parse($message['created_at'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</td>
              <td>{{ $message['name'] }}</td>
              <td>{{ $message['lastname'] }}</td>
              <td>{{ $message['email'] }}</td>
              <td>{{ $message['flat_id'] }}</td>
              <td class="align-middle">
                <a href="{{ route('admin.messages.show', $message['id']) }}" class="btn btn-dark">Leggi messaggio</a>
              </td>
              <td class="align-middle">
                  <form action="{{ route('admin.messages.destroy', $message['id']) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <input class="btn btn-dark" type="submit" value="Cancella messaggio">
                  </form>
              </td>
            </tr>
            @endforeach
          </tbody>
      </table> 
    @endif
</div>
@endsection
