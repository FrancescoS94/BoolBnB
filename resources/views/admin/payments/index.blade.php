{{-- VISUALIZZI TUTTI I PAGAMENTI DELL'UTENTE LOGGATO --}}
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
        <h1>Tutti i pagamenti effettuati</h1>

        @if(count($payments) == 0)
            <p>Non hai ancora sponsorizzato nessun appartamento.</p>
        @elseif(count($payments) > 0)

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Data pagamento</th>
                        <th scope="col">Appartamento</th>
                        <th scope="col">Durata sponsorizzazione</th>
                        <th scope="col">Fine sponsorizzazione</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ Carbon\Carbon::parse($payment['created_at'])->settings(['toStringFormat' => 'j F Y', ]) }}</td>
                        <td>{{ $payment['flat_id'] }}</td>
                        <td>{{$payment->rate->hours}} ore</td>
                        <td>{{ Carbon\Carbon::parse($payment['end_rate'])->settings(['toStringFormat' => 'j F Y \a\l\l\e h:i:s', ]) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
