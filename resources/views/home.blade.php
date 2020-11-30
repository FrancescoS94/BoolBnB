{{-- PAGINA INDEX --}}
@extends('layouts.app')

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="js/slider.js" type="text/javascript"></script>
    <script src="js/icon-scroll.js" type="text/javascript"></script>
    {{-- SCRIPT DI ALGOLIA --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script> --}}
    <script src="js/algolia.js" type="text/javascript"></script>
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
                        {{-- <h5><span class="badge">Città</span></h5> --}}
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