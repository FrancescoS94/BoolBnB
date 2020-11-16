{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')
@section('content')

<h2>SEARCH</h2>

{{-- RAGA per visualizzare questa parte in homepage dovete
    1. andare su mysql nella tabella payments
    2. impostare a qualche pagamento un valore end_rate la data di domani --}}

<div class="container-fluid search">

    <div class="row">

      <div class="col">
        @foreach ($flatsSpons as $flatSpons)
        <div class="row flat">
          <div class="col-5">
            <a href="{{ route('flats.show', $flatSpons->id) }}"><img id="img-search" src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}"></a>
          </div>

          <div class="col-6">
            <a href="{{ route('flats.show', $flatSpons->id) }}">
              <div class="">
                <h5 class="card-title">{{ $flatSpons->title}}</h5>
                <p class="card-text">{{ $flatSpons->description}}</p>

              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      <div class="col-4 mappa">
         mappa
      </div>

    </div>

</div>

@endsection
