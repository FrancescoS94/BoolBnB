{{-- PAGINA INDEX --}}
@extends('layouts.app')
@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('admin/home') }}">Home</a>
            @else
            
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Progetto Boolean 16, pagina home
        </div>
    </div>

    {{-- appartamenti sponsorizzati (vale) --}}

    <div>
        <h2>Appartamenti sponsorizzati</h2>
        {{-- RAGA per visualizzare questa parte in homepage dovete
            1. andare su mysql nella tabella payments
            2. impostare a qualche pagamento un valore end_rate la data di domani --}}
       {{--  <div class="card-group">
            @foreach ($flatsSpons as $flatSpons)
            <div class="card"> --}}
                {{-- <span class="badge badge-secondary">{{ $flatSpons->address->city }}</span> badge in cui metterei la città. da qualche parte va segnalato
                <img src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}"> {{-- immagine della casa. non si vede perchè lorempicsum fa schifo, dovremmo acambiare delle impostazioni
                <div class="card-body">
                    <h5 class="card-title">{{ $flatSpons->title}}</h5>{{-- titolo dell'appartamento -
                    <p class="card-text">{{ $flatSpons->description}}</p>{{-- descrizione dell'appartamento -
                    <a href="{{ route('flat', $flatSpons->id) }}" class="btn btn-primary">Vai alla show dell'appartamento</a> --}} {{-- bottone per andare nella show dell'appartamento --}}
              {{--   </div>
            </div>
            @endforeach --}}

            pagina guest visualizza tutti gli appartamenti 
            {{-- @dd($flat) --}}
        </div>
    </div>

</div>
@endsection

