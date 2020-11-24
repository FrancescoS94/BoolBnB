{{-- APPARTAMENTI INSERITI DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')
@section('content')
    <div class="container vh">
        {{-- d-flex justify-content-center --}}
        <div class="row">
            <div class="col-10">

                {{-- <h1>Ciao {{ Auth::user()->name }}</h1> --}}
                {{-- se l'utente non ha completato la registrazione non potrà inserire appartamenti --}}
                @if(is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth ))
                    <h2>Completa il tuo profilo prima di inserire un appartamento!</h2>
                @else
                {{--<a href="{{ route('admin.addresses.create') }}" class="card-link"> il btn crea un appartamento porta a admin.addresses.create e poi a admin.flats.create
                    <button type="button" class="btn btn-success">Aggiungi un appartamento</button>
                </a>--}}

                <a href="{{ route('admin.addresses.create') }}" class="card-link">
                    <button type="button" class="btn-blu my-3">Aggiungi un appartamento</button>
                </a>
                @endif

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
                <table class="table table-active">
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
                            <td>{{$flat->bed}}</td>
                            <td>{{$flat->room}}</td>
                            <td>{{$flat->wc}}</td>
                            <td>{{$flat->mq}}</td>
                            <td>
                                <img class="img-fluid" src="{{url('storage/'. $flat->image)}}" alt="{{$flat->title}}">
                                {{-- <img class="img-fluid" src="{{ Storage::url("/storage/app/{$flat->image}") }}" alt="{{$flat->title}}"> --}}
                            </td>
                            </div>
                            <td>
                                <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.flats.edit', $flat->id )}}">Modifica</a>
                            </td>
                            {{-- <td><a class="btn btn-primary" role="button" href="{{route('admin.addresses.edit', [$flat->id, $flat->address->id] )}}" class="card-link">Modifica</a></td> --}}
                            <td>
                                <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.flats.show', $flat->id)}}">Visualizza</a>
                            </td>
                            <td>
                                <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.payments.create', $flat->id)}}">Sponsorizza</a>
                            </td>
                            <td>{{-- elimina l'appartamento, attraverso l'id --}}
                                <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-red">Cancella</button>
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
