{{-- PAGINA DI RICERCA --}}
@extends('layouts.app')
@section('content')
    <p>SEARCH</p>



    <div class="container-fluid">

      @foreach ($flatsSpons as $flatSpons)
      <div class="row flat">

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
          <img id="provaImg" src="{{ $flatSpons->image }}" class="card-img-top" alt="{{ $flatSpons->title}}"> {{-- immagine della casa. non si vede perchè lorempicsum fa schifo, dovremmo acambiare delle impostazioni --}}
        </div>

        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
          <div class="">
            <h5 class="card-title">{{ $flatSpons->title}}</h5>{{-- titolo dell'appartamento --}}
            <p class="card-text">{{ $flatSpons->description}}</p>{{-- descrizione dell'appartamento --}}
            <a href="{{ route('flat', $flatSpons->id) }}" class="btn btn-primary">Vai alla show dell'appartamento</a> {{-- bottone per andare nella show dell'appartamento --}}
          </div>
        </div>

      </div>
      @endforeach

    </div>



@endsection
