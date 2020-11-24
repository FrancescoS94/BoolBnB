{{-- @dd($messaggio); --}}
{{-- PAGINA DI RICERCA --}}
{{-- @dd($flatsInRadius); --}}
@extends('layouts.app')
@section('content')

{{-- <h2>Risultati Ricerca</h2> --}}

 {{--RAGA per visualizzare questa parte in homepage dovete
    1. andare su mysql nella tabella payments
    2. impostare a qualche pagamento un valore end_rate la data di domani--}}

<div class="layout">

  <div class="left-layout">

    <div class="container-fluid search">
      <h2>Appartamenti sponsorizzati</h2>
      @foreach ($flatsSpons as $flatSpons)
      <div class="row flat">
        <div class="my-auto col-xl-5">
          <a href="{{ route('flats.show', $flatSpons->id) }}"><img id="img-search" src="{{ asset('storage/'.$flatSpons->image ) }}" class="card-img-top" alt="{{ $flatSpons->title}}"></a>
        </div>
        <div class="col-xl-6">
            <div class="flat-text">
              <a href="{{ route('flats.show', $flatSpons->id) }}">
                <h5 class="card-title">{{ $flatSpons->title}}</h5>
                <p>{{ $flatSpons->address->address }}</p>
                <ul>
                  <li>
                    <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="">
                    Letti: {{$flatSpons->bed}}
                  </li>
                  <li>
                    <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="">
                    Stanze: {{$flatSpons->room}}
                  </li>
                </ul>
                  <ul>
                    <li>
                      <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="">
                      WC: {{$flatSpons->wc}}
                    </li>
                    <li>
                      <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="">
                      Mq: {{$flatSpons->mq}}
                    </li>
                  </ul>
              </a>
              <div class="flat-service">
                @foreach($flatSpons->services as $service)
                <span> {{ $service->service }} </span>
                @endforeach
              </div>
            </div>

        </div>
      </div>
      @endforeach
    </div> {{-- fine appartamenti sponsorizzati  --}}


    {{-- appartamenti ricercati  --}}
    <div class="container-fluid search">
      <h2>Appartamenti ricercati </h2>
      @foreach ($flatsInRadius as $flat)
      <div class="row flat">
        <div class="my-auto col-xl-5">
          <a href="{{ route('flats.show', $flat->id) }}"><img id="img-search" src="{{ asset('storage/'.$flat->image ) }}" class="card-img-top" alt="{{ $flatSpons->title}}"></a>
        </div>
        <div class="col-xl-6">
            <div class="flat-text">
              <a href="{{ route('flats.show', $flat->id) }}">
                <h5 class="card-title">{{ $flat->title}}</h5>
                <p>{{ $flat->address->address }}</p>
                <ul>
                  <li>
                    <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="">
                    Letti: {{$flat->bed}}
                  </li>
                  <li>
                    <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="">
                    Stanze: {{$flat->room}}
                  </li>
                </ul>
                  <ul>
                    <li>
                      <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="">
                      WC: {{$flat->wc}}
                    </li>
                    <li>
                      <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="">
                      Mq: {{$flat->mq}}
                    </li>
                  </ul>
              </a>
              <div class="flat-service">
                @foreach($flat->services as $service)
                <span> {{ $service->service }} </span>
                @endforeach
              </div>
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
