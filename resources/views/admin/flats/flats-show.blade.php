{{-- SHOW DEL SINGOLO APPARTAMENTO DELL'UTENTE LOGGATO --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                {{-- dettagli inseriti come esempio --}} 
                <img style="width:250px" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}" class="img-thumbnail">
                <div>Data di creazione {{$flat->created_at}}</div>
                <p class="text-justify">{{$flat->description}}</p>
            </div>
        </div>
    </div>
@endsection