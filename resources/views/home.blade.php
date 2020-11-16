@dd($flatsSpons);
{{-- PAGINA INDEX --}}
@extends('layouts.app')
@section('content')
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

{{-- BANNER --}}
<section class="bg-img">
    <div class="container-fluid">
        <div class="jumbotron col-sm-8 col-md-6 col-lg-6">
            <h1>Viaggiare sentendoti a casa tua</h1>
        </div>
    </div>
</section>

<div class="container-fluid sponsor">
    <div class="box-cards">

<div class="card-group">
    <div class="card">
        <a href="#">
            <img class="img-fluid" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
        </a>
    </div>
    <div class="card-body">
        <h5>Milano</h5>
        <h6>Nome appartamento</h6>
    </div>    


    

        <div class="card-group">
            <div class="card">
                <a href="#">
                    <img class="img-fluid" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
                </a>
            </div>
            <div class="card-body">
                <h5>Milano</h5>
                <h6>Nome appartamento</h6>
            </div>
        </div>


        <div class="card-group">
            <div class="card">
                <a href="#">
                    <img class="img-fluid" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
                </a>
            </div>
            <div class="card-body">
                <h5>Milano</h5>
                <h6>Nome appartamento</h6>
            </div>
        </div>


        <div class="card-group">
            <div class="card">
                <a href="#">
                    <img class="img-fluid" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
                </a>
            </div>
            <div class="card-body">
                <h5>Milano</h5>
                <h6>Nome appartamento</h6>
            </div>
        </div>

    </div>








</div>


{{-- appartamenti sponsorizzati (vale) --}}

<div>
    <h2>Appartamenti sponsorizzati</h2>
        {{-- RAGA per visualizzare questa parte in homepage dovete
        1. andare su mysql nella tabella payments
        2. impostare a qualche pagamento un valore end_rate la data di domani --}}
    <div class="card-group">
        @foreach ($flatsSpons as $flatSpons)
        <div class="card">
            <span class="badge badge-secondary">{{ $flatSpons->address->city }}</span> {{-- badge in cui metterei la città. da qualche parte va segnalato --}}
            <img src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}"> {{-- immagine della casa. non si vede perchè lorempicsum fa schifo, dovremmo acambiare delle impostazioni --}}
            <div class="card-body">
                <h5 class="card-title">{{ $flatSpons->title}}</h5>{{-- titolo dell'appartamento --}}
                <p class="card-text">{{ $flatSpons->description}}</p>{{-- descrizione dell'appartamento --}}
                <a href="{{ route('flats.show', $flatSpons->id) }}" class="btn btn-primary">Vai alla show dell'appartamento</a> {{-- bottone per andare nella show dell'appartamento --}}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
