{{-- PAGINA INDEX --}}
@extends('layouts.app')
@section('content')
<div class="flex-center position-ref full-height">
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

    <div class="content">
        <div class="title m-b-md">
            Progetto Boolean 16, pagina home
        </div>
    </div>

    {{-- appartamenti sponsorizzati (vale) --}}

    <div>
        <h2>Appartamenti sponsorizzati</h2>
        <div class="card-group">
            @foreach ($flatsSpons as $flatSpons)
            {{-- bisognerà aggiungere qui la città --}}
            <div class="card">
                {{-- risolvere questione immagini --}}
                <span class="badge badge-secondary">{{ $flatSpons->address->city }}</span>
                <img src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}">
                <div class="card-body">
                    <h5 class="card-title">{{ $flatSpons->title}}</h5>
                    <p class="card-text">{{ $flatSpons->description}}</p>
                    <a href="{{ route('flat', $flatSpons->id) }}" class="btn btn-primary">Vai alla show dell'appartamento</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

