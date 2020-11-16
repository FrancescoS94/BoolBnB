
{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                {{-- dettagli inseriti come esempio --}} 
                <img style="width:250px" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}" class="img-thumbnail">
                <h1>{{$flat->title}}</h1>
                <span>Data di creazione: {{$flat->created_at}}</span>
                <p class="text-justify">{{$flat->description}}</p>
                <h2>Servizi disponibili</h2>

                @foreach ($service as $service)
                <p class="text-justify">{{$service->service}}</p>
                @endforeach
                
                <ul>
                    <li>Id: {{$flat->id}}</li>
                    <li>Stanze: {{$flat->room}}</li>
                    <li>Letti: {{$flat->bed}}</li>
                    <li>Bagni: {{$flat->wc}}</li>
                    <li>MQ: {{$flat->mq}}</li>
                </ul>
                <a class="btn btn-primary" role="button" href="{{route('admin.payments.create', $flat->id)}}" class="card-link">Sponsorizza</a>
            </div>
        </div>
    </div>
@endsection