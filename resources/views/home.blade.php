{{-- PAGINA INDEX --}}
@extends('layouts.app')

@section('head')
    <style>
        #erroreRicerca{ 
            width: 6rem;
            position: relative;
            left: 42%;
            top: -20px;
            font-size: 18px;
            width: 180px !important;
            padding: 15px 13px;
            border-radius: 9px;
        }
    </style>
@endsection

@section('script-in-head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
@endsection

@section('content')
{{-- BANNER --}}
{{-- quando si elimina il form di sopra, aggiungere la class "padd-top" accanto a "map-view" --}}
<section class="container-fluid bg-img">
    <div class="jumbotron col-sm-12 col-md-6 col-lg-6">
        <h1>Viaggiare<br>sentendosi<br>a casa</h1>
    </div>
    <i class="rotate far fa-arrow-alt-circle-down"></i>
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
@endsection

@section('script-in-body')
<script>


    // SCRIPT DI ALGOLIA
        (function() {
            var list=[];
            var placesAutocomplete = places({
                appId: 'plHDPE6IE51U',
                apiKey: '13f35e1233e3a7aedf08241d21430869',
                container: document.querySelector('#city'),
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

            

            document.getElementById('clickMe').addEventListener('click', function(){
                //var city =  document.getElementById('city').value;
                const city = document.getElementById('city').value;

                const form = document.getElementById('form');
                form.addEventListener('submit', (e) => {

                    if(list.length == 0){
                        let city =document.getElementById('city').value = 'Inserisci una città!';
                        e.preventDefault(); 
                    }

                }); 


                if(list.length != 0 || city != ''){
                    for(var i=0; i<list.length; i++){
                    if(list[i]['name'] === city){
                        var lat = list[i]['latlng']['lat'];
                        var lng = list[i]['latlng']['lng'];
                        var querylat = document.getElementById('query_lat').value =  lat;
                        var querylng = document.getElementById('query_lng').value =  lng;
                    }
                  }    
                }
            });

            


        })();
</script>
@endsection