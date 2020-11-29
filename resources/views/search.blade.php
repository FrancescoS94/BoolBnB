{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')

@section('head')

  <script src="js/slider.js" type="text/javascript"></script>
  {{-- SCRIPT DI ALGOLIA --}}
  <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
  {{-- SCRIPT HANDLEBARS --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" integrity="sha512-zT3zHcFYbQwjHdKjCu6OMmETx8fJA9S7E6W7kBeFxultf75OPTYUJigEKX58qgyQMi1m1EgenfjMXlRZG8BXaw==" crossorigin="anonymous"></script>
  {{-- SCRIPT ALGOLIA E FILTRI --}}
  <script src="js/algolia-filtri-search.js" type="text/javascript"></script>

@endsection

@section('content')

<div class="container-fluid layout">
  <div>
    <input type="search" id="city1" class="form-control" placeholder="In which city do you live?" value="{{$city}}" /> {{-- id = city --}}
    <input class="query_lat" type="text" name="query_lat" hidden value="{{$lat}}"> {{-- cambia con id --}}
    <input class="query_lng" type="text" name="query_lng" hidden value="{{$lng}}">
    <button id="click" class="btn btn-dark">cerca per città e filtra</button>
  </div>

  <section class="filter">
    <div class="filter-child">
      <h4>Filtri services</h4>
      <div class="service_each">
      @foreach($service as $service)
        <div class="form-check form-check-inline">
          <input class="form-check-input serviceClick" type="checkbox" id="{{ $service->service }}" value="{{ $service->id }}">
          <label class="form-check-label" for="{{ $service->service }}">{{ $service->service }}</label>
        </div>
      @endforeach
      </div>
    </div>
  
    <div class="filter-child">
        <h4>Filtri flats</h4>
        <div class="form-group">
          <label for="room">Stanze</label>
          <input class="form-control" id="room" type="number">
        </div>
        <div class="form-group">
          <label for="bed">Letti</label>
          <input class="form-control" id="bed" type="number">
        </div>
        <div class="form-group">
          <label for="wc">Bagni</label>
          <input  class="form-control" id="wc" type="number">
        </div>
        <div class="form-group">
          <label for="mq">Quanto spazio cerchi?</label>
          <select id="mq" class="form-control">
            <option selected value="">Metri quadrati</option>
            <option value="50">0 - 50</option>
            <option value="100">50 - 100</option>
            <option value="150">100 - 150</option>
            <option value="200">150 - 200</option>
            <option value="250">200 - 250</option>
            <option value="300">250 - 300</option>
            <option value="301">>300</option>
          </select>
        </div>
    </div>

    <div id="filtroRicerca" hidden>Nessun risultato con questi filtri</div>
    
  </section>

   <section class="container-fluid sponsor">

    <h2>Scopri i nostri migliori appartamenti</h2>
    {{-- SLIDER CON FLEX E BOOTSTRAP --}}
    <div class="slider">
        <i class="fas fa-chevron-left left"></i>
        <div class="lista appartamenti">
            @foreach ($flatsSpons as $flatSpons)
            <div class="elemento col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('flats.show', $flatSpons->id) }}">
                <div style="background-image: url({{asset('storage/'. $flatSpons->image)}});" class="box-group">
                    <div class="box-descr" style="color:#fff">
                        <h5><span class="badge">Città</span></h5>
                        <h3>{{ $flatSpons->title}}</h3>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
        <i class="fas fa-chevron-right right"></i>
    </div>

</section>
  <div class="container ricerca">
    @foreach ($flatsInRadius as $flat)
    <div class="row search">
      <div class="foto col-9 col-sm-6 col-md-6 col-lg-6 col-xl-5 ">
        <a href="{{ route('flats.show', $flat->id) }}"><img id="img-search" src="{{ asset('storage/'.$flat->image ) }}" class="img-fluid" alt="{{ $flat->title}}"></a>
      </div>
      <div class="my-auto col-9 col-sm-6 col-md-6 col-lg-6 col-xl-6 ">
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
    </div> {{-- chiusura row search--}}
    @endforeach
  </div> {{-- chiusura container-fluid ricerca--}}
</div> {{-- chiusura layout --}}

{{-- modello di riferimento handlebars --}}
<script id="template" type="text/x-handlebars-template">
  <div class="row flat">
    <div class="my-auto col-xl-5">
    <a href="http://localhost:8000/flats/@{{id}}"><img id="img-search" src="storage/@{{{image}}}" class="card-img-top" alt="@{{title}}"></a>
    </div>
    <div class="col-xl-6">
        <div class="flat-text">
          <a id="paginaInterna" href="http://localhost:8000/flats/@{{id}}"> <!-- http://localhost:8000/flats/@{{id}} -->
            <h5 class="card-title">@{{title}}</h5>
            <p class="address">@{{address}}</p> <!-- prendere l'indirizzo -->
            <ul>
              <li>
                <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="">
                <p class="bed">Letti: @{{bed}}</p>
              </li>
              <li>
                <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="">
                <p class="room">Stanze: @{{room}}</p>
              </li>
            </ul>
              <ul>
                <li>
                  <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="">
                  <p class="wc">WC: @{{wc}}</p>
                </li>
                <li>
                  <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="">
                  <p class="mq">Mq: @{{mq}}</p>
                </li>
              </ul>
          </a>
        </div>
    </div>
  </div>
</script>

@endsection
