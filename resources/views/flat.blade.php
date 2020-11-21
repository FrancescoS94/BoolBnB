@extends('layouts.app')

@section('name')
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps.css'>
    <link rel='stylesheet' type='text/css' href='{{asset('css/index.css')}}'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/Minimap/1.0.5//Minimap.css'/>
    <style>
        .js-foldable {
            width: 300px;
        }

        .tt-params-box__header {
            padding-left: 0;
            padding-right: 0;
        }

        .tt-params-box__content {
            padding-left: 0;
            padding-right: 0;
        }

        .tt-params-box {
            box-shadow: none;
            margin-top: 8px;
        }
    </style>   
@endsection

@section('content')
    <div class="container flat-show flat-title">
        <h1 class="pt-5">Titolo appartamento</h1>
        <div class="row">
            {{-- IMAGE --}}
            <div class="col-md-12 col-lg-7">
                <div class="flat-img">
                    {{-- src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}" --}}
                    <img class="img-thumbnail border-0" src="https://www.triesteallnews.it/wp-content/images/2019/08/affitti-brevi-appartamenti.jpg"  alt="">
                </div>
            </div>
            {{-- DESCRIPTION, FEATURES & SERVICES --}}
            <div class="col-md-12 col-lg-5">
                <div>
                    <p class="text-justify flat-descr">{{$flat->description}}</p>
                </div>
                <ul>
                    <li class="float-left bed">
                        <img src="{{asset('image\bed.png')}}" alt="Icon Bed">
                        Letti: {{$flat->bed}}
                    </li>
                    <li>
                        <img src="{{asset('image\room.png')}}" alt="Icon Room">
                        Stanze: {{$flat->room}}
                    </li>
                    <li class="float-left wc">
                        <img src="{{asset('image\bath.png')}}" alt="Icon WC">
                        WC: {{$flat->wc}}
                    </li>
                    <li>
                        <img src="{{asset('image\plans.png')}}" alt="Icon Mq">
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
            <div class="col-md-7 col-lg-6 pos">
                <h2>Posizione</h2>
                <div id='map' class='map'>
                    <div class='tt-overlay-panel -left-top -medium js-foldable'>
                        <form>
                            <label class='tt-form-label'>
                                Map zoom: <span id='mapZoom'></span>
                            </label>
                            <label class='tt-form-label'>
                                Minimap zoom: <span id='minimapZoom'></span>
                            </label>
                            <div class='tt-params-box'>
                                <header class='tt-params-box__header'>
                                    Minimap parameters
                                </header>
                                <div class='tt-params-box__content'>
                                    <label class='tt-form-label'>
                                        Zoom level offset (<span id='zoomLevelOffsetCounter' class='tt-counter'>5</span>)
                                        <input id='zoomLevelOffsetSlider' class='tt-slider' type='range' min='3' max='8' value='5'/>
                                    </label>
                                    <label class='tt-form-label'>
                                        Minimap min zoom (<span id='minZoomCounter' class='tt-counter'>3</span>)
                                        <input id='minZoomSlider' class='tt-slider' type='range' min='0' max='6' value='3'/>
                                    </label>
                                    <label class='tt-form-label'>
                                        Minimap max zoom (<span id='maxZoomCounter' class='tt-counter'>15</span>)
                                        <input id='maxZoomSlider' class='tt-slider' type='range' min='6' max='22' value='15'/>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-lg-1 col-lg-5 jumbotron pos">
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
        <script type='text/javascript' src='{{asset('')}}../assets/js/polyfills.js'></script>
        <script type='text/javascript' src='{{asset('js/foldable.js')}}'></script>
        <script type='text/javascript' src='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/Minimap/1.0.5//Minimap-web.js'></script>
        <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps-web.min.js'></script>
        <script type='text/javascript' src='{{asset('js/mobile-or-tablet.js')}}'></script>
        <script>

            $.ajax({
                type: "GET",
                url: "http://localhost:8000/api/addresses/id",
                // data: "data",
                success: function (response) {
                    console.log(response);
                },error: function(error){
                    console.log('errore' + error);
                }
            });


            // Define your product name and version.
            tt.setProductInfo('mini_map_flat', '0');

            var map = tt.map({
                key: '2i5JG6LMTO5fGDQWBZvdwyjIYaoMYrbi',
                container: 'map',
                style: 'tomtom://vector/1/basic-main',
                dragPan: !isMobileOrTablet(),
                center: [-0.12634, 51.50276],
                zoom: 15
            });

            var minimapOptions = {
                ttMapsSdk: tt,
                zoomOffset: 5,
                mapOptions: {
                    key: '2i5JG6LMTO5fGDQWBZvdwyjIYaoMYrbi',
                    style: 'tomtom://vector/1/basic-main',
                    minZoom: 3,
                    maxZoom: 15
                }
            };

            var minimap = new tt.plugins.Minimap(minimapOptions);

            map.addControl(minimap, 'bottom-right');
            new Foldable('.js-foldable', 'top-right');

            function updateMinimapZoomLevelCounter() {
                document.getElementById('minimapZoom').innerText = minimap.getMap().getZoom().toFixed(2);
            }

            function updateMapZoomLevelCounter() {
                document.getElementById('mapZoom').innerText = map.getZoom().toFixed(2);
            }

            function updateMinimapMinZoomLevel() {
                var minZoom = parseInt(document.getElementById('minZoomSlider').value, 10);
                document.getElementById('minZoomCounter').innerText = minZoom;
                minimapOptions = Object.assign({ mapOptions: Object.assign(minimapOptions.mapOptions || {}, {minZoom: minZoom}) },
                    minimapOptions);
                minimap.getMap().setMinZoom(minZoom);
                updateMinimapZoomLevelCounter();
            }

            function updateMinimapMaxZoomLevel() {
                var maxZoom = parseInt(document.getElementById('maxZoomSlider').value, 10);
                document.getElementById('maxZoomCounter').innerText = maxZoom;
                minimapOptions = Object.assign({mapOptions: Object.assign(minimapOptions.mapOptions || {}, {maxZoom: maxZoom})},
                    minimapOptions);
                minimap.getMap().setMaxZoom(maxZoom);
                updateMinimapZoomLevelCounter();
            }

            function updateMinimap(minimapOptions) {
                map.removeControl(minimap);
                minimap = new tt.plugins.Minimap(minimapOptions);
                map.addControl(minimap, 'bottom-right');
                minimap.getMap().on('zoom', updateMinimapZoomLevelCounter);
                updateMinimapZoomLevelCounter();
            }

            function updateZoomLevelOffset() {
                var offset = parseInt(document.getElementById('zoomLevelOffsetSlider').value, 10);
                document.getElementById('zoomLevelOffsetCounter').innerText = offset;
                minimapOptions = Object.assign(minimapOptions, {zoomOffset: offset});
                updateMinimap(minimapOptions);
            }

            updateMapZoomLevelCounter();
            updateMinimapZoomLevelCounter();

            map.on('zoom', updateMapZoomLevelCounter);
            minimap.getMap().on('zoom', updateMinimapZoomLevelCounter);
            document.getElementById('zoomLevelOffsetSlider').addEventListener('change', updateZoomLevelOffset);
            document.getElementById('minZoomSlider').addEventListener('change', updateMinimapMinZoomLevel);
            document.getElementById('maxZoomSlider').addEventListener('change', updateMinimapMaxZoomLevel);

            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
        </script>
    </div>
@endsection
