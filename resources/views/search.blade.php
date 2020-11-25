
@extends('layouts.app')

<div class="container-fluid layout">

  {{-- <div class="row filtri">
    <div class="col-12 filters">
      <p>FILTRI</p>
    </div>
  </div> --}}

  <section class="container-fluid sponsor">
    <h2>Scorri i nostri migliori appartamenti</h2>
    <div class="row">
        <i class="fas fa-chevron-left left"></i>
        <div class="lista appartamenti">
            @foreach ($flatsSpons as $flatSpons)
            <div style="background-image: url({{asset('storage/'. $flatSpons->image)}});" class="col-12 col-sm-6 col-md-4 col-lg-3 box-group">
                <a href="{{ route('flats.show', $flatSpons->id) }}">
                    <div class="box-descr" style="color:#fff">
                        <h5><span class="badge">Città</span></h5>
                        <h3>{{ $flatSpons->title}}</h3>
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