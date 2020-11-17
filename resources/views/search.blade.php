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
        <input type="search" id="address-input" placeholder="Where are we going?" />
        @foreach ($flatsSpons as $flatSpons)
        <div class="row flat">
          <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
            <a href="{{ route('flats.show', $flatSpons->id) }}"><img id="img-search" src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}"></a>
          </div>

          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 k">
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
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script>
        var placesAutocomplete = places({
            appId: 'plO1TPEC5GEF',
            apiKey: '320a8e600bcf0d2590a8e31ad067d31c',
            container: document.querySelector('#address-input')
          });
    </script>
</div>

@endsection
