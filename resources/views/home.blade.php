{{-- PAGINA INDEX --}}
@extends('layouts.app')
@section('content')

{{-- BANNER --}}
<section class="bg-img">
    <div class="container-fluid">
        <div class="jumbotron col-sm-8 col-md-6 col-lg-6">
            <h1>Viaggiare sentendoti a casa tua</h1>
        </div>
    </div>
</section>

<div class="container sponsor">

{{-- A: {{ route('flats.show', $flatSpons->id) }} --}}
{{-- IMG: {{ $flatSpons->image }} --}}
{{-- H6: {{ $flatSpons->title}} --}}
{{-- H5: aggiungere nel database la città --}}
    <div class="row">
        @foreach ($flatsSpons as $flatSpons)
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 box-group">
            <div class="box-img">
                <a href="{{ route('flats.show', $flatSpons->id) }}">
                    <img class="" src="{{ $flatSpons->image }}" alt="">
                </a>
            </div>
            <div class="box-descr">
                <h5>{{ $flatSpons->address->city }}</h5>
                <h6>{{ $flatSpons->title}}</h6>
            </div>
        </div>
        @endforeach
    </div>
</div>
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
