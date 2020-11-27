@extends('layouts.app')

@section('head')
    {{-- STILE MAPPA --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.37.2/maps/maps.css'/>
    <style>
        /* STILE MAPPA */
        #map {
            height: 500px;
            width: 500px;
        }
    </style>
@endsection

@section('script-in-head')

    {{-- SCRIPT TOMTOM PER MAPPA --}}
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.37.2/maps/maps-web.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script> --}}
@endsection

@section('content')
    <div class="container flat-show flat-title padd-top">
        {{-- input nascosti per passare lat, lng e indirizzo alla mappa --}}
        <input class="lat" type="text" hidden value="{{$flat->address->lat}}">
        <input class="lng" type="text" hidden value="{{$flat->address->lng}}">
        <input class="address" type="text" hidden value="{{$flat->address->address}}">

        <h2 class="pt-5">{{$flat->title}}</h2>
        <div class="row">
            {{-- IMAGE --}}
            <div class="col-md-12 col-lg-7">
                <div class="flat-img">
                    <img class="img-thumbnail border-0" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}">
                </div>
            </div>
            {{-- DESCRIPTION, FEATURES & SERVICES --}}
            <div class="col-md-12 col-lg-5">
                <div>
                    <p class="text-justify flat-descr">{{$flat->description}}</p>
                </div>
                <ul>
                    <li class="float-left bed">
                        <img src="{{ asset('storage/bed.png')}}" alt="Icon Bed">
                        Letti: {{$flat->bed}}
                    </li>
                    <li>
                        <img src="{{ asset('storage/room.png')}}" alt="Icon Room">
                        Stanze: {{$flat->room}}
                    </li>
                    <li class="float-left wc">
                        <img src="{{ asset('storage/bath.png')}}" alt="Icon WC">
                        WC: {{$flat->wc}}
                    </li>
                    <li>
                        <img src="{{ asset('storage/plans.png')}}" alt="Icon Mq">
                        Mq: {{$flat->mq}}
                    </li>
                </ul>
                <h2>Servizi</h2>
                <div class="services">
                    @foreach ($service as $service)
                        <p class="text-justify">· {{$service->service}}</p>
                    @endforeach
                </div>
            </div>
            {{-- TOMTOM & FORM --}}
            <div class="col-md-7 col-lg-6 mt-5">
                <h2>Posizione</h2>
                {{-- MAPPA CON MARKER --}}
                <div id='map'></div>
            </div>
            <div class="col-md-5 offset-lg-1 col-lg-5 jumbotron mt-5">
                <div id="form-messaggio">
                    <h2>Contatta l'host</h2>
                    {{-- STATUS --}}
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- CONTROLLO ERRORI --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{-- FORM --}}
                    <form action="{{ route('messages.store') }}" method="post">
                        @csrf
                        @method('POST')
                        {{-- PASSO L'ID DEL FLAT IN UN INPUT NASCOSTO --}}
                        <input hidden type="text" name="flat" class="form-control" value="{{ $flat->id }}">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nome</label>
                                <input name="name" type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Cognome</label>
                                <input name="lastname" type="text" class="form-control" id="lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="mail" class="form-control" id="email" placeholder="Inserisci la tua email">
                        </div>
                        <div class="form-group">
                            <label for="request">Messaggio</label>
                            <textarea rows="3" name="request" type="text" class="form-control" id="request" placeholder="Invia un messaggio al proprietario">{{ old('request') }}</textarea>
                        </div>
                        <button type="submit" class="btn">Invia</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script-in-body')
    <script>
        // SCRIPT DI ALGOLIA PER INPUT DI RICERCA
        (function() {
            var list=[];                                    // creo un array vuoto in cui inserisco tutti i suggerimenti di algolia
            var placesAutocomplete = places({
                appId: 'plHDPE6IE51U',
                apiKey: '13f35e1233e3a7aedf08241d21430869',
                container: document.querySelector('#city'),
                templates: {
                    value: function(suggestion){
                        list.push(suggestion);              // man mano che vengono generati inserisco tutti i suggerimenti nell'array
                        return suggestion.name;
                    }
                }
            }).configure({
                type: 'city',                               // i risultati devono essere solo città
                aroundLatLngViaIP: false,                   // non mi interessa partire dalla posizione dell'utente
            });

            document.getElementById('clickMe').addEventListener('click', function(){        // al click sul bottone
                var city =  document.getElementById('city').value;                          // memorizzo il valore dell'input
                for(var i=0; i<list.length; i++){                                           // ciclo l'array di suggerimenti
                    if(list[i]['name'] === city){                                           // risalgo al suggerimento selezionato
                        var lat = list[i]['latlng']['lat'];                                 // estraggo la latitudine
                        var lng = list[i]['latlng']['lng'];                                 // estraggo la longitudine
                        var querylat = document.getElementById('query_lat').value =  lat;   // e li memorizzo in due variabili
                        var querylng = document.getElementById('query_lng').value =  lng;
                    }
                }
            });
        })();

        // INIZIO script per tomtom
        // DISPLAYING A MAP WITH LOCATION MARKER WITH TOMTOM

        var lat = $('input.lat').val();
        var lng = $('input.lng').val();

        var flatLatLng = [lng, lat];                                    // memorizzo le coordinate dell'appartamento in un array

        var map = tt.map({
            container: 'map',
            key: '2i5JG6LMTO5fGDQWBZvdwyjIYaoMYrbi',
            style: 'tomtom://vector/1/basic-main',
            center: flatLatLng,                                         // le setto come centro della mappa
            zoom: 10
        });

        var marker = new tt.Marker().setLngLat(flatLatLng).addTo(map);  // aggiungo un marker

        var popupOffsets = {
            top: [0, 0],
            bottom: [0, -70],
            'bottom-right': [0, -70],
            'bottom-left': [0, -70],
            left: [25, -35],
            right: [-25, -35]
        }

        var title = $('h2').html();                                     // personalizzo il marker con i dati dell'appartamento
        var address = $('input.address').val();

        var popup = new tt.Popup({offset: popupOffsets}).setHTML("<h5>" + title + "</h5><span>" + address + "</span>");
        marker.setPopup(popup).togglePopup();

    </script>
@endsection
