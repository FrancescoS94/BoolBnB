{{-- APPARTAMENTI INSERITI DELL'UTENTE LOGGATO --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <h1>Ciao {{ Auth::user()->name }}</h1>
                <a href="{{ route('admin.addresses.create') }}" class="card-link"> {{-- il btn crea un appartamento porta a admin.addresses.create e poi a admin.flats.create --}}
                    <button type="button" class="btn btn-success">Aggiungi un appartamento</button>
                </a>

                 {{-- validazione campi  --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                    {{-- esito dell'operazione  --}}
                    @if(session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>  
                    @endif
                    
                 {{-- ciclo i valori che ritornano dal controller con il compact! mostro tutti gli appartamenti dell'utente loggato --}} 
                 <table class="table table-dark">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">bed</th>
                        <th scope="col">room</th>
                        <th scope="col">wc</th>
                        <th scope="col">mq</th>
                        <th scope="col">image</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($flats as $flat)
                      <tr>
                        <th scope="row">{{$flat->id}}</th>
                        <td>{{$flat->title}}</td>
                        <td>{{$flat->created_at}}</td>
                        <td>{{$flat->bed}}</td>
                        <td>{{$flat->room}}</td>
                        <td>{{$flat->wc}}</td>
                        <td>{{$flat->mq}}</td>
                        <td><img style="width:30px" src="{{asset('storage/'. $flat->image)}}" alt="{{$flat->title}}"></td>
                        <td><a class="btn btn-primary" role="button" href="{{route('admin.flats.edit', $flat->id )}}" class="card-link">Modifica</a></td>
                        {{-- <td><a class="btn btn-primary" role="button" href="{{route('admin.addresses.edit', [$flat->id, $flat->address->id] )}}" class="card-link">Modifica</a></td> --}}
                        <td><a class="btn btn-primary" role="button" href="{{route('admin.flats.show', $flat->id)}}" class="card-link">Visualizza</a></td>
                        <td><a class="btn btn-primary" role="button" href="#" class="card-link">Sponsorizza</a></td>
                        <td>{{-- distruggi l'appartamento, attraverso l'id --}}
                            <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancella</button>
                            </form>
                        </td>
                        
                      </tr>
                        @endforeach <!-- Chiusura padre contenitore foreach -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection