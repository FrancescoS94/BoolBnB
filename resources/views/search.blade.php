{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')
@section('content')
    <p>SEARCH</p>

    {{-- appartamenti sponsorizzati (vale) --}}

    <div>
        <h2>Appartamenti sponsorizzati</h2>
        {{-- RAGA per visualizzare questa parte in homepage dovete
            1. andare su mysql nella tabella payments
            2. impostare a qualche pagamento un valore end_rate la data di domani --}}
        <div class="card-group">
            @foreach ($flatsSpons as $flatSpons)
            <div class="card">
                <span class="badge badge-secondary">{{ $flatSpons->address->city }}</span> {{-- badge in cui metterei la città. da qualche parte va segnalato --}}
                <img src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}"> {{-- immagine della casa. non si vede perchè lorempicsum fa schifo, dovremmo acambiare delle impostazioni --}}
                <div class="card-body">
                    <h5 class="card-title">{{ $flatSpons->title}}</h5>{{-- titolo dell'appartamento --}}
                    <p class="card-text">{{ $flatSpons->description}}</p>{{-- descrizione dell'appartamento --}}
                    <a href="{{ route('flats.show', $flatSpons->id) }}" class="btn btn-primary">Vai alla show dell'appartamento</a> {{-- bottone per andare nella show dell'appartamento --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
