{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')
@section('content')

<h2>Risultati Ricerca</h2>

{{-- RAGA per visualizzare questa parte in homepage dovete
    1. andare su mysql nella tabella payments
    2. impostare a qualche pagamento un valore end_rate la data di domani --}}

<div class="layout">

  <div class="left-layout">
    <div class="container-fluid search">
      @foreach ($flatsSpons as $flatSpons)
      <div class="row flat">
        <div class="col-sm-12 col-md-12 col-lg-7 col-xl-5">
          <a href="{{ route('flats.show', $flatSpons->id) }}"><img id="img-search" src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}"></a>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-6">
            <div class="">
              <a href="{{ route('flats.show', $flatSpons->id) }}">
                <h5 class="card-title">{{ $flatSpons->title}}</h5>
                <p class="card-text">Camere da letto: {{ $flatSpons->room}}, Letti: {{ $flatSpons->bed}}, Bagni: {{ $flatSpons->wc}}, mq: {{ $flatSpons->mq}}</p>
                <p class="card-text">Servizi:</p>
              </a>
            </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="right-layout">
    <p>Mappa Mappa Mappa Mappa Mappa Mappa</p>
  </div>

</div>





@endsection
