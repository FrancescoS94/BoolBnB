
{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                {{-- dettagli inseriti come esempio --}} 
                <h1>{{$flat->title}}</h1>
                <img style="width:250px" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}" class="img-thumbnail">
                <span>Data di creazione: {{$flat->created_at}}</span>
                <p class="text-justify">{{$flat->description}}</p>
                <h2>Servizi disponibili</h2>

                @foreach ($service as $service)
                <p class="text-justify">{{$service->service}}</p>
                @endforeach
               
                <ul>
                    <li>Id: {{$flat->id}}</li>
                    <li>Letti: {{$flat->bed}}</li>
                    <li>Stanze: {{$flat->room}}</li>
                    <li>Bagni: {{$flat->wc}}</li>
                    <li>Metri quadrati: {{$flat->mq}}</li>
                </ul>
                <a class="btn btn-primary" role="button" href="{{route('admin.flats.edit', $flat->id )}}" class="card-link">Modifica</a>
                <a class="btn btn-primary" role="button" href="{{ route('admin.payments.create', $flat->id)}}" class="card-link">Sponsorizza</a>
                <td>{{-- distruggi l'appartamento, attraverso l'id --}}
                    <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancella</button>
                    </form>
                </td>
            </div>
        </div>
    </div>
@endsection