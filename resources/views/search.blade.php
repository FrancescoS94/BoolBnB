{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')
@section('content')


<input type="search" id="city" class="form-control" placeholder="In which city do you live?" />
<input id="query_lat" type="text" name="query_lat" hidden>
<input id="query_lng" type="text" name="query_lng" hidden>  
<button id="clickMe">cerca</button>

<div class="layout">
  <div class="left-layout">




     {{-- appartamenti sponsorizzati  --}}
    {{-- <div class="container-fluid search">
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
    </div> --}} {{-- fine appartamenti sponsorizzati  --}}


    


    {{-- appartamenti ricercati  --}}
    <div id="template-container" class="container-fluid search">
      <h2>Appartamenti ricercati </h2>
      <div id="search-child">
        @foreach ($flatsInRadius as $flat)
        <div class="row flat">
          <div class="my-auto col-xl-5">
            <a href="{{ route('flats.show', $flat->id) }}"><img id="img-search" src="{{ asset('storage/'.$flat->image ) }}" class="card-img-top" alt="{{ $flat->title}}"></a>
          </div>
          <div class="col-xl-6">
              <div class="flat-text">
                <a href="{{ route('flats.show', $flat->id) }}">
                  <h5 class="card-title">{{ $flat->title}}</h5>
                  <p class="address">{{ $flat->address->address }}</p>
                  <ul>
                    <li>
                      <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="">
                      <p class="bed">Letti: {{$flat->bed}}</p> 
                    </li>
                    <li>
                      <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="">
                      <p class="room">Stanze: {{$flat->room}}</p> 
                    </li>
                  </ul>
                    <ul>
                      <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="">
                        <p class="wc">WC: {{$flat->wc}}</p> 
                      </li>
                      <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="">
                        <p class="mq">Mq: {{$flat->mq}}</p>
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
      </div> {{-- fine searh-child --}}
    </div>



    {{-- template --}}
    {{-- <div id="template-container" class="container-fluid search">
      <h2>Appartamenti ricercati</h2>
    </div> --}}



</div> {{-- fine left-layout --}}

  <div class="right-layout">
    <p>Mappa Mappa Mappa Mappa Mappa Mappa</p>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" integrity="sha512-zT3zHcFYbQwjHdKjCu6OMmETx8fJA9S7E6W7kBeFxultf75OPTYUJigEKX58qgyQMi1m1EgenfjMXlRZG8BXaw==" crossorigin="anonymous"></script>
<script>


var list=[]; // array di ricerca
(function() { // funzione algolia di ricerca
      
  var placesAutocomplete = places({
    appId: 'plHDPE6IE51U',
    apiKey: '13f35e1233e3a7aedf08241d21430869',
    container: document.querySelector('#city'),
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
$('#clickMe').unbind().bind('click', function(){   /* metodo alternativo document.getElementById('clickMe').addEventListener('click', function(){}); // chiusura evento bottone */
  
  var city =  document.getElementById('city').value;
  if(city == ''){
    document.querySelector('.left-layout').innerHTML = '<h2>Inserisci un città!</h2>';
  }

  //document.querySelector('.left-layout').innerHTML = '';
  $('#search-child').empty();

  //reset();  
  var geo= [];
  
  for(var i=0; i<list.length; i++){
    if(list[i]['name'] === city){ // se c'è corrispondenza  

      var lat = list[i]['latlng']['lat'];
      var lng = list[i]['latlng']['lng'];
      // loro due prendono i valori di latitudine e longitudine e li spediscono al controller! 
      var querylat = document.getElementById('query_lat').value =  lat;                       
      var querylng = document.getElementById('query_lng').value =  lng;
        
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
    let temp = $('#search-child').append(html);
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
