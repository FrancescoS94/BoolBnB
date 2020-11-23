{{-- PAGINA INDEX --}}
@extends('layouts.app')
@section('content')

<style>
    .mapboxgl-canvas{
        display: none;
    }

    .map-view{
        position: absolute;
    }

    .algolia-places {
    width: 20%;
    }

    #map-example-container {height: 300px};

</style>

<form action="{{route('flats.index')}}" method="GET">
    <input class="search-text" type="text" name="query_search" placeholder="Inizia la ricerca">
    <button>Cerca</button>
</form>

{{-- aggiunta 18-11-20 tomtom --}}
<div class='map-view'>
    <div class='tt-side-panel' style="height: 40vh;">
        <header class='tt-side-panel__header'>
        </header>
        <div class='tt-tabs js-tabs'>
            <div class='tt-tabs__panel'>
                <div class='js-results' hidden='hidden'></div>
                <div class='js-results-loader' hidden='hidden'>
                    <div class='loader-center'><span class='loader'></span></div>
                </div>
                <div class='tt-tabs__placeholder js-results-placeholder'></div>
            </div>
        </div>
    </div>
    <div id='map' class='full-map' style="height: 40vh;"></div>
</div> {{-- fine tomtom --}}

{{-- BANNER --}}
<section class="bg-img">
    <div class="container-fluid">
        <div class="jumbotron col-sm-8 col-md-6 col-lg-6">
            <h1>Viaggiare sentendoti a casa tua</h1>
        </div>
    </div>
</section>

<section class="container-fluid sponsor">

    {{-- FRANCESCO --}}
    {{-- A: {{ route('flats.show', $flatSpons->id) }} --}}
    {{-- IMG: {{ $flatSpons->image }} --}}
    {{-- H6: {{ $flatSpons->title}} --}}
    {{-- H5: aggiungere nel database la città --}}
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

<<<<<<< HEAD
    <script>

       //$("#screenName").on("keyup",function()

        /* $(document).on('click','a.search-btn',function(){
            var search = $('input.search-text').val();
            if(search != ''){

                $.ajax({
                    type: "GET",
                    url:  "http://localhost:8000/api/addresses",
                    success: function(response){
                        var list= [];
                        for(var i=0; i<response.length; i++){
                            var indirizzo = response[i]['address'];

                            if(indirizzo.toLowerCase().includes(search)){
                                var obj=response[i];
                                list.push(obj);
                                var objpassato= JSON.stringify(list);
                            }// chiusura if
                        } // chiusura for

                        /* console.log(objpassato);
                        $.ajax({
                            type: "GET",
                            url: 'api/flats',
                            data: objpassato,
                            dataType: "json",
                            }).done(function(messaggio){
                                 alert("Successo");
                            }).fail(function(error){
                                //alert("Errore");
                                console.log(error, 'errore interno!!')
                        });
                    },error: function(error){
                        console.log('errore', error);
                    }
                })
            }
        }); */

        // });
                /* $.ajax({indirizzo.filter(query)
                type: "GET",
                url: "http://localhost:8000/api/addresses",
                data:
                success: function (response) {

                    console.log(response); */

                    /* for(var i=0; i<response.length; i++){
                        var indirizzo = response[i]['address'];

                        if(indirizzo.filter(query)){
                            console.log('okay trovata');
                        }else{
                            console.log('non trovato');
=======

    
    {{-- aggiunta 18-11-20 tomtom --}}
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/maps/maps-web.min.js'></script>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.64.0/services/services-web.min.js'></script>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.24.2//SearchBox-web.js'></script>
    <script type='text/javascript' src='{{ asset('js/guest-search-marker.js')}}' ></script>
    <script type='text/javascript' src='{{ asset('js/search-results-parser.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/search-markers-manager.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/info-hint.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/mobile-or-tablet.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/results-manager.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/side-panel.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/dom-helpers.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/formatters.js')}}'></script>

      
    
      <script>
                    tt.setProductInfo('search-mappa', '0');

                    var map = tt.map({
                        key: '2i5JG6LMTO5fGDQWBZvdwyjIYaoMYrbi',
                        container: 'map',
                        center: [15.4, 53.0],
                        zoom: 3,
                        style: 'tomtom://vector/1/basic-main',
                        dragPan: !window.isMobileOrTablet()
                    });

                    var infoHint = new InfoHint('info', 'bottom-center', 5000).addTo(document.getElementById('map'));
                    var errorHint = new InfoHint('error', 'bottom-center', 5000).addTo(document.getElementById('map'));

                    // Options for the fuzzySearch service
                    var searchOptions = {
                        key: '2i5JG6LMTO5fGDQWBZvdwyjIYaoMYrbi',
                        language: 'en-Gb',
                        limit: 5
                    };

                    // Options for the autocomplete service
                    var autocompleteOptions = {
                        key: '2i5JG6LMTO5fGDQWBZvdwyjIYaoMYrbi',
                        language: 'en-Gb'
                    };

                    var searchBoxOptions = {
                        minNumberOfCharacters: 0,
                        searchOptions: searchOptions,
                        autocompleteOptions: autocompleteOptions
                    };
                    var ttSearchBox = new tt.plugins.SearchBox(tt.services, searchBoxOptions);
                    document.querySelector('.tt-side-panel__header').appendChild(ttSearchBox.getSearchBoxHTML());

                    var state = {
                        previousOptions: {
                            query: null,
                            center: null
                        },
                        callbackId: null
                    };

                    map.addControl(new tt.FullscreenControl());
                    map.addControl(new tt.NavigationControl());
                    new SidePanel('.tt-side-panel', map);
                    var resultsManager = new ResultsManager();
                    var searchMarkersManager = new SearchMarkersManager(map);

                    map.on('load', handleMapEvent);
                    map.on('moveend', handleMapEvent);

                    ttSearchBox.on('tomtom.searchbox.resultscleared', handleResultsCleared);
                    ttSearchBox.on('tomtom.searchbox.resultsfound', handleResultsFound);
                    ttSearchBox.on('tomtom.searchbox.resultfocused', handleResultSelection);
                    ttSearchBox.on('tomtom.searchbox.resultselected', handleResultSelection);

                    function handleMapEvent() {
                        // Update search options to provide geobiasing based on current map center
                        var oldSearchOptions = ttSearchBox.getOptions().searchOptions;
                        var oldautocompleteOptions = ttSearchBox.getOptions().autocompleteOptions;
                        var newSearchOptions = Object.assign({}, oldSearchOptions, { center: map.getCenter() });
                        var newAutocompleteOptions = Object.assign({}, oldautocompleteOptions, { center: map.getCenter() });
                        ttSearchBox.updateOptions(Object.assign(
                            {},
                            searchBoxOptions,
                            { placeholder: 'Query e.g. Washington' },
                            { searchOptions: newSearchOptions },
                            { autocompleteOptions: newAutocompleteOptions }
                        ));
                    }

                    function handleResultsCleared() {
                        searchMarkersManager.clear();
                        resultsManager.clear();
                    }

                    function handleResultsFound(event) {
                        // Display fuzzySearch results if request was triggered by pressing enter
                        if (event.data.results && event.data.results.fuzzySearch && event.data.metadata.triggeredBy === 'submit') {
                            var results = event.data.results.fuzzySearch.results;

                            if (results.length === 0) {
                                handleNoResults();
                            }
                            searchMarkersManager.draw(results);
                            resultsManager.success();
                            fillResultsList(results);
                            fitToViewport(results);
                        }

                        if (event.data.errors) {
                            errorHint.setMessage('There was an error returned by the service.');
>>>>>>> 21-11-20SeraMaik
                        }
                    }

                    function handleResultSelection(event) {
                        if (isFuzzySearchResult(event)) {
                            // Display selected result on the map
                            var result = event.data.result;
                            resultsManager.success();
                            searchMarkersManager.draw([result]);
                            fillResultsList([result]);
                            searchMarkersManager.openPopup(result.id);
                            fitToViewport(result);
                            state.callbackId = null;
                            infoHint.hide();
                        } else if (stateChangedSinceLastCall(event)) {
                            var currentCallbackId = Math.random().toString(36).substring(2, 9);
                            state.callbackId = currentCallbackId;
                            // Make fuzzySearch call with selected autocomplete result as filter
                            handleFuzzyCallForSegment(event, currentCallbackId);
                        }
                    }

                    function isFuzzySearchResult(event) {
                        return !('matches' in event.data.result);
                    }

                    function stateChangedSinceLastCall(event) {
                        return Object.keys(searchMarkersManager.getMarkers()).length === 0 || !(
                            state.previousOptions.query === event.data.result.value &&
                            state.previousOptions.center.toString() === map.getCenter().toString());
                    }

                    function getBounds(data) {
                        var btmRight;
                        var topLeft;
                        if (data.viewport) {
                            btmRight = [data.viewport.btmRightPoint.lng, data.viewport.btmRightPoint.lat];
                            topLeft = [data.viewport.topLeftPoint.lng, data.viewport.topLeftPoint.lat];
                        }
                        return [btmRight, topLeft];
                    }

                    function fitToViewport(markerData) {
                        if (!markerData || markerData instanceof Array && !markerData.length) {
                            return;
                        }
                        var bounds = new tt.LngLatBounds();
                        if (markerData instanceof Array) {
                            markerData.forEach(function (marker) {
                                bounds.extend(getBounds(marker));
                            });
                        } else {
                            bounds.extend(getBounds(markerData));
                        }
                        map.fitBounds(bounds, { padding: 100, linear: true });
                    }

                    function handleFuzzyCallForSegment(event, currentCallbackId) {
                        var query = ttSearchBox.getValue();
                        var segmentType = event.data.result.type;

                        var commonOptions = Object.assign({}, searchOptions, {
                            query: query,
                            limit: 15,
                            center: map.getCenter(),
                            typeahead: true
                        });

                        var filter;
                        if (segmentType === 'category') {
                            filter = { categorySet: event.data.result.id };
                        }
                        if (segmentType === 'brand') {
                            filter = { brandSet: event.data.result.value };
                        }
                        var options = Object.assign({}, commonOptions, filter);

                        infoHint.setMessage('Loading results...');
                        errorHint.hide();
                        resultsManager.loading();
                        tt.services.fuzzySearch(options)
                            .go()
                            .then(function (response) {

                                if (state.callbackId !== currentCallbackId) {
                                    return;
                                }
                                if (response.results.length === 0) {
                                    handleNoResults();
                                    return;
                                }
                                resultsManager.success();
                                searchMarkersManager.draw(response.results);
                                fillResultsList(response.results);
                                map.once('moveend', function () {
                                    state.previousOptions = {
                                        query: query,
                                        center: map.getCenter()
                                    };
                                });
                                fitToViewport(response.results);
                                /* console.log(response.results) */

                            })
                            .catch(function (error) {
                                if (error.data && error.data.errorText) {
                                    errorHint.setMessage(error.data.errorText);
                                }
                                resultsManager.resultsNotFound();
                            })
                            .finally(function () {
                                infoHint.hide();
                            });
                    }

                    function handleNoResults() {
                        resultsManager.clear();
                        resultsManager.resultsNotFound();
                        searchMarkersManager.clear();
                        infoHint.setMessage(
                            'No results for "' +
                            ttSearchBox.getValue() +
                            '" found nearby. Try changing the viewport.'
                        );
                    }

                    function fillResultsList(results) {
                        resultsManager.clear();
                        var resultList = DomHelpers.createResultList();
                        results.forEach(function (result) {
                            var distance = SearchResultsParser.getResultDistance(result);
                            var searchResult = DomHelpers.createSearchResult(
                                SearchResultsParser.getResultName(result),
                                SearchResultsParser.getResultAddress(result),
                                distance ? Formatters.formatAsMetricDistance(distance) : ''
                            );
                            var resultItem = DomHelpers.createResultItem();
                            resultItem.appendChild(searchResult);
                            resultItem.setAttribute('data-id', result.id);
                            resultItem.onclick = function (event) {
                                var id = event.currentTarget.getAttribute('data-id');
                                searchMarkersManager.openPopup(id);
                                searchMarkersManager.jumpToMarker(id);
                            };
                            resultList.appendChild(resultItem);
                        });
                        resultsManager.append(resultList);
                    }
                </script>




            







   
</section>
@endsection


{{-- <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('admin/home') }}">Home</a>
            @else

                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div> --}}
