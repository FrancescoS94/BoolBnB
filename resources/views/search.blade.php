{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')
@section('content')

<div class="container-fluid layout">
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
  <div class="container-fluid row">

    <div class="col-3 filtri">
      <div class="città-filtri">
        <input type="search" id="city1" class="form-control" placeholder="In which city do you live?" value="{{$city}}" /> {{-- id = city --}}
        <input class="query_lat" type="text" name="query_lat" hidden value="{{$lat}}"> {{-- cambia con id --}}
        <input class="query_lng" type="text" name="query_lng" hidden value="{{$lng}}">
        <button id="click" class="btn-blu">Cerca per città e filtra</button>
      </div>

      <section class="filter">
        <div class="filter-child-services">
          <h4>Filtra per servizi</h4>
          <div class="service_each">
          @foreach($service as $service)
            <div class="form-check form-check-inline">
              <input class="form-check-input serviceClick" type="checkbox" id="{{ $service->service }}" value="{{ $service->id }}">
              <label class="form-check-label" for="{{ $service->service }}">{{ $service->service }}</label>
            </div>
          @endforeach
          </div>
        </div>

        <div class="filter-child-flats">
            <h4>Altri Filtri</h4>
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
                <option selected>Metri quadrati</option>
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
    </div>

    <div class="ricerca col-9">
      @foreach ($flatsInRadius as $flat)
      <div class="row search">
        <div class="foto col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
          <a href="{{ route('flats.show', $flat->id) }}"><img id="img-search" src="{{ asset('storage/'.$flat->image ) }}" class="img-fluid" alt="{{ $flat->title}}"></a>
        </div>
        <div class="my-auto col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
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


  </div>
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


  let selectedMq = $("select#mq").children("option:selected").val();

  let serviceList = []; // torna tutti i servizi scelti
    $('.serviceClick:checked').each(function(){
    serviceList.push(this.value);
  });

  //console.log(selectedMq, serviceList)

  $('.ricerca').empty();


  if(list.length != 0){
    var geo= [];
    for(var i=0; i<list.length; i++){
    if(list[i]['name'] === city){ // se c'è corrispondenza
      var lat = list[i]['latlng']['lat'];
      var lng = list[i]['latlng']['lng'];

      // loro due prendono i valori di latitudine e longitudine e li spediscono al controller!
      var querylat = document.querySelector('.query_lat').value =  lat;
      var querylng = document.querySelector('.query_lng').value =  lng;
      if(!geo.includes(querylat) && !geo.includes(querylng)){
        geo.push(querylat);
        geo.push(querylng);
      }

      } // chiusura if list[i]
    } // chiusura for

    list= [];
  }else{
    let lat = $('.query_lat').val();
    let lng = $('.query_lng').val();

    geo = [
      lat,
      lng
    ];
  }


  // prendo i valori dei filtri flats
  let room = $('#room').val();
  let bed = $('#bed').val();
  let wc = $('#wc').val();

  // richiamo la funzione call ed effettuo la chiamata!
  call(geo,room,bed,wc,selectedMq,serviceList);
});
// funzione chiamata ajax con parametro in ingresso

function call(listageo, room='', bed='', wc='', selectedMq='',serviceList= ''){
  $.ajax({
        /* cache: false, */
        type: "GET",
        url: "http://localhost:8000/flats",
        data: {
          geo: listageo,
          room: room,
          bed: bed,
          wc: wc,
          selectedMq: selectedMq,
          serviceList: serviceList
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
</script>

{{-- modello di riferimento --}}
{{-- <script id="template" type="text/x-handlebars-template">
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
</script> --}}

<script id="template" type="text/x-handlebars-template">
<div class="ricerca col-12">
  @foreach ($flatsInRadius as $flat)
  <div class="row search">
    <div class="foto col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
      <a href="http://localhost:8000/flats/@{{id}}"><img id="img-search" src="storage/@{{{image}}}" class="img-fluid" alt="@{{title}}"></a>
    </div>
    <div class="my-auto col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
      <div class="flat-text">
        <a id="paginaInterna" href="http://localhost:8000/flats/@{{id}}">
          <h5 class="card-title">@{{title}}</h5>
          <p>@{{address}}</p>
          <ul>
            <li>
              <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="">
              Letti: @{{bed}}
            </li>
            <li>
              <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="">
              Stanze: @{{room}}
            </li>
          </ul>
            <ul>
              <li>
                <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="">
                WC: @{{wc}}
              </li>
              <li>
                <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="">
                Mq: @{{mq}}
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




<script>
/*   document.getElementById('paginaInterna').addEventListener('click', function(){
    alert('ciao');
  }); */

  $(document).on("click", "#paginaInterna", function(){

    var city =  document.getElementById('city1').value;
    let lat = document.querySelector('.query_lat').value; //$('.query_lat').val();
    let lng = document.querySelector('.query_lng').value; //$('.query_lng').val();
    var link = $(this).attr('href');

    let geo = [
      lat,
      lng,
      city
    ];

    //console.log(geo);
    //console.log(link, city, lat, lng);
/*     $.ajax({
        type: "get",
        url: link,       //"http://localhost:8000/flats/" +
        data: {
          geo: geo
        },
        dataType: "json",
        success: function (response){}
    }); */

  });
</script>
@endsection
