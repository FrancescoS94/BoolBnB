{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')

@section('script-in-head')
  
@endsection

@section('content')

<div class="layout padd-top">

  <div class="left-layout">

    <div class="container">
      <h3>Filtri</h3>

        <input type="search" id="city-filtri" class="search-text form-control" placeholder="Dove sogni di andare?" />
        {{-- NASCOSTO --}}<input id="query_lat" type="text" name="query_lat" hidden>
        {{-- NASCOSTO --}}<input id="query_lng" type="text" name="query_lng" hidden>
        <button class="search-btn" id="clickMe-filtri"><i class="fa fa-search"></i></button>
    
      <div>
        <h4>Filtri services</h4>
        @foreach($service as $service)
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="{{ $service->service }}" value="{{ $service->service }}">
          <label class="form-check-label" for="{{ $service->service }}">{{ $service->service }}</label>
        </div>
        @endforeach
      </div>
      <div>
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
          <label for="mq">Metri quadrati</label>
          <input class="form-control" id="mq" type="number">
        </div>
      </div>
      <button id="filtra" type="button" class="btn btn-dark">FILTRA</button>
    </div>
        

    <div class="container-fluid search">
      <h2>Appartamenti sponsorizzati</h2>
      @foreach ($flatsSpons as $flatSpons)
      <div class="row flat">
        <div class="my-auto col-12 col-sm-12 col-md-6 col-lg-6 col-xl-5">
          <a href="{{ route('flats.show', $flatSpons->id) }}"><img id="img-search" src="{{ asset('storage/'.$flatSpons->image ) }}" class="img-fluid" alt="{{ $flatSpons->title}}"></a>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-6">
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

@section('script-in-body')
<script>
  // SCRIPT DI ALGOLIA
  (function() {
        var list=[];
        var placesAutocomplete = places({
            appId: 'plHDPE6IE51U',
            apiKey: '13f35e1233e3a7aedf08241d21430869',
            container: document.querySelector('#city-filtri'),
            templates: {
                value: function(suggestion){
                    list.push(suggestion);
                    return suggestion.name;
                }
            }
        }).configure({
            type: 'city',
            aroundLatLngViaIP: false,
        });

        document.getElementById('clickMe-filtri').addEventListener('click', function(){
            var city =  document.getElementById('city-filtri').value;
            for(var i=0; i<list.length; i++){
                if(list[i]['name'] === city){
                    var lat = list[i]['latlng']['lat'];
                    var lng = list[i]['latlng']['lng'];
                    var querylat = document.getElementById('query_lat').value =  lat;
                    var querylng = document.getElementById('query_lng').value =  lng;
                    $.ajax({
                        type: "GET",
                        url: 'http://localhost:8000/api/flats',
                        data: {
                          query_lat: querylat,
                          query_lng: querylng
                        },
                        dataType: "json",
                        }).done(function(messaggio){
                            console.log("Successo");
                        }).fail(function(error){
                            //alert("Errore");
                            console.log(error, 'errore interno!!');
                    });
                }
            }
        });
    })();

    
  //  $(document).on('click','button#filtra',function(){
  //     var search = $('input.search-text').val();
  //     if(search != ''){

  //         $.ajax({
  //             type: "GET",
  //             url:  "http://localhost:8000/api/addresses",
  //             success: function(response){
  //                 var list= [];
  //                 for(var i=0; i<response.length; i++){
  //                     var indirizzo = response[i]['address'];

  //                     if(indirizzo.toLowerCase().includes(search)){
  //                         var obj=response[i];
  //                         list.push(obj);
  //                         var objpassato= JSON.stringify(list);
  //                     }// chiusura if
  //                 } // chiusura for

  //                 console.log(objpassato);
  //                 $.ajax({
  //                     type: "GET",
  //                     url: 'api/flats',
  //                     data: objpassato,
  //                     dataType: "json",
  //                     }).done(function(messaggio){
  //                           alert("Successo");
  //                     }).fail(function(error){
  //                         //alert("Errore");
  //                         console.log(error, 'errore interno!!')
  //                 });
  //             },error: function(error){
  //                 console.log('errore', error);
  //             }
  //         })
  //     }
  // });
    </script>
@endsection