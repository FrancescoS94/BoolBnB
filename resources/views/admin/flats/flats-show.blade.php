
{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                {{-- dettagli inseriti come esempio --}}
                <h1>{{$flat->title}}</h1>
                <img  class="img-thumbnail" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}">
                <span>Data di creazione: {{ Carbon\Carbon::parse($flat->created_at)->settings(['toStringFormat' => 'j F Y', ]) }}</span>
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
                    <li>Indirizzo: {{$flat->address->address}}</li>
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
