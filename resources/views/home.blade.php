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

<div class="container-fluid">

{{-- A: {{ route('flats.show', $flatSpons->id) }} --}}
{{-- IMG: {{ $flatSpons->image }} --}}
{{-- H6: {{ $flatSpons->title}} --}}
{{-- H5: aggiungere nel database la città --}}
    <div class="row sponsor">
        {{-- @foreach ($flatsSpons as $flatSpons) --}}
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 box-group">
            <div class="box-img">
                <a href="#">
                    <img class="" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
                </a>
                <div class="box-descr">
                    <h5>Milano</h5>
                    <h6>Nome appartamento</h6>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}


        <div class="col-12 col-sm-6 col-md-4 col-lg-3 box-group">
            <div class="box-img">
                <a href="#">
                    <img class="" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
                </a>
            </div>
            <div class="box-descr">
                <h5>Milano</h5>
                <h6>Nome appartamento</h6>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 box-group">
            <div class="box-img">
                <a href="#">
                    <img class="" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
                </a>
            </div>
            <div class="box-descr">
                <h5>Milano</h5>
                <h6>Nome appartamento</h6>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 box-group">
            <div class="box-img">
                <a href="#">
                    <img class="" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
                </a>
            </div>
            <div class="box-descr">
                <h5>Milano</h5>
                <h6>Nome appartamento</h6>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 box-group">
            <div class="box-img">
                <a href="#">
                    <img class="" src="https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg" alt="">
                </a>
            </div>
            <div class="box-descr">
                <h5>Milano</h5>
                <h6>Nome appartamento</h6>
            </div>
        </div>



    </div>


</div>


{{-- appartamenti sponsorizzati (vale) --}}


@endsection
