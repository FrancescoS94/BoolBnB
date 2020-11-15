{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')
@section('content')

<h2>SEARCH</h2>

{{-- RAGA per visualizzare questa parte in homepage dovete
    1. andare su mysql nella tabella payments
    2. impostare a qualche pagamento un valore end_rate la data di domani --}}


<div class="container-fluid search">

  @foreach ($flatsSpons as $flatSpons)
    <div class="row flat">

      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
        <img id="img-search" src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}"> {{-- immagine della casa. non si vede perchè lorempicsum fa schifo, dovremmo acambiare delle impostazioni --}}
      </div>

      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
        <div class="">
          <h5 class="card-title">{{ $flatSpons->title}}</h5>{{-- titolo dell'appartamento --}}
          <p class="card-text">{{ $flatSpons->description}}</p>{{-- descrizione dell'appartamento --}}
          <a href="{{ route('flats.show', $flatSpons->id) }}" class="btn btn-primary">Vai alla show dell'appartamento</a> {{-- bottone per andare nella show dell'appartamento --}}
        </div>
      </div>

      <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 map">

      </div>

    </div>
  @endforeach

</div>

@endsection
