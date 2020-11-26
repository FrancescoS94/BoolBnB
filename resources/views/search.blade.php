{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')
@section('content')
<div class="container-fluid layout">
  <div>
    <input type="search" id="city1" class="form-control" placeholder="In which city do you live?" /> {{-- id = city --}}
    <input class="query_lat" type="text" name="query_lat" hidden> {{-- cambia con id --}}
    <input class="query_lng" type="text" name="query_lng" hidden>
    <button id="click">cerca</button>
  </div>
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
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" integrity="sha512-zT3zHcFYbQwjHdKjCu6OMmETx8fJA9S7E6W7kBeFxultf75OPTYUJigEKX58qgyQMi1m1EgenfjMXlRZG8BXaw==" crossorigin="anonymous"></script>
<script>
var list=[]; // array di ricerca
(function() { // funzione algolia di ricerca
  var placesAutocomplete = places({
    appId: 'plHDPE6IE51U',
    apiKey: '13f35e1233e3a7aedf08241d21430869',
    container: document.querySelector('#city1'),
    templates: {
      value: function(suggestion){
        list.push(suggestion); // popolo l'array con i valori di ritorno di algolia
        return suggestion.name;
      }
    }
  }).configure({
      type: 'city',
      aroundLatLngViaIP: false,
  });
})(); // fine funzione algolia di ricerca
// funzione click bottone
$('#click').unbind().bind('click', function(){   /* metodo alternativo document.getElementById('clickMe').addEventListener('click', function(){}); // chiusura evento bottone */
  var city =  document.getElementById('city1').value;
  if(city == ''){
    document.querySelector('.left-layout').innerHTML = '<h2>Inserisci un città!</h2>';
  }
  //document.querySelector('.left-layout').innerHTML = '';
  $('.ricerca').empty();
  //reset();
  var geo= [];
  for(var i=0; i<list.length; i++){
    if(list[i]['name'] === city){ // se c'è corrispondenza
      var lat = list[i]['latlng']['lat'];
      var lng = list[i]['latlng']['lng'];
      // loro due prendono i valori di latitudine e longitudine e li spediscono al controller!
      /* var querylat = document.getElementById('query_lat').value =  lat;
      var querylng = document.getElementById('query_lng').value =  lng; */
      var querylat = document.querySelector('.query_lat').value =  lat;
      var querylng = document.querySelector('.query_lng').value =  lng;
      if(!geo.includes(querylat) && !geo.includes(querylng)){
        geo.push(querylat);
        geo.push(querylng);
      }
      //document.querySelector('.left-layout').innerHTML = ''; // quando ricerco pulisci la pagina
    } // chiusura if list[i]
  } // chiusura for
  // richiamo la funzione call ed effettuo la chiamata!
  call(geo);
});
// funzione chiamata ajax con parametro in ingresso
function call(listageo){
  $.ajax({
        cache: false,
        type: "GET",
        url: "http://localhost:8000/flats",
        data: {
          lat: listageo
        },
        dataType: "json",
  }).done(function(response){
      console.log(response);
      compiler(response); // richiamo la funzione per compilare il model
  }).fail(function(error){
    console.log('errore',error);
  });
}
function compiler(response){
  // copia baffi
  let source = $("#template").html();
  let template = Handlebars.compile(source);
  for(let i=0; i < response.length; i++){
    let context={
      title: response[i].title,
      address: response[i].address_id,
      bed: response[i].bed,
      description: response[i].description,
      mq: response[i].mq,
      room: response[i].room,
      wc: response[i].wc,
      image: response[i].image,
      id: response[i].id
    }
    let html = template(context);
    let temp = $('.ricerca').append(html);
  }
}
/* function reset(){
    $('#city').val('');
    $('.left-layout').html('');
}; */
</script>
{{-- modello di riferimento --}}
<script id="template" type="text/x-handlebars-template">
  <div class="row flat">
    <div class="my-auto col-xl-5">
    <a href="http://localhost:8000/flats/@{{id}}"><img id="img-search" src="storage/@{{{image}}}" class="card-img-top" alt="@{{title}}"></a>
    </div>
    <div class="col-xl-6">
        <div class="flat-text">
          <a href="http://localhost:8000/flats/@{{id}}">
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
