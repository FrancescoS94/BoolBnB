@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    
                </div>
            </div>

            pagina home 
        </div>
    </div>
</div>
@endsection


  {{-- <div> {{-- filtri di ricerca
    <h4>Filtri services</h4>
    @foreach($service as $service)
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" id="{{ $service->service }}" value="{{ $service->service }}">
      <label class="form-check-label" for="{{ $service->service }}">{{ $service->service }}</label>
    </div>
    @endforeach
</div>

    <div>
        <h4>Filtri flats</h4>
        <div class="form-group">
        <label for="room">Stanze</label>
        <input class="form-control" id="room" type="number">
        </div>
        <div class="form-group">
        <label for="bed">Letti</label>
        <input class="form-control" id="bed" type="number">
        </div>
        <div class="form-group">
        <label for="wc">Bagni</label>
        <input  class="form-control" id="wc" type="number">
        </div>
        <div class="form-group">
        <label for="mq">Metri quadrati</label>
        <input class="form-control" id="mq" type="number">
        </div>
    </div>
    <button id="filtra" type="button" class="btn btn-dark">FILTRA</button> 
