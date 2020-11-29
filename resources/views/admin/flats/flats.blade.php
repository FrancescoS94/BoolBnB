{{-- APPARTAMENTI INSERITI DELL'UTENTE LOGGATO --}}
@extends('layouts.admin')
@section('content')
    <div class="container flats-list vh">
        <div class="row">
            <div class="col-12">
                {{-- <h1>Ciao {{ Auth::user()->name }}</h1> --}}
                {{-- se l'utente non ha completato la registrazione non potrà inserire appartamenti --}}
                @if(is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth ))
                    <h2 class="font-weight-bold py-3">Completa il tuo profilo prima di inserire un appartamento!</h2>
                @else
                <h2 class="font-weight-bold py-3 pb">I tuoi appartamenti</h2>
                {{-- il btn "aggiungi un appartamento" porta a admin.addresses.create e poi a admin.flats.create --}}
                <a href="{{ route('admin.addresses.create') }}" class="card-link">
                    <button type="button" class="btn-blu mb-4">Aggiungi</button>
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
                <table class="table">
                    <thead>
                        <tr>
                            <th class="tb-none" scope="col">Title</th>
                            <th class="tb-none" scope="col">bed</th>
                            <th class="tb-none" scope="col">room</th>
                            <th class="tb-none" scope="col">wc</th>
                            <th class="tb-none" scope="col">mq</th>
                            <th class="tb-none" scope="col">image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flats as $flat)
                        <tr>
                            <td>{{$flat->title}}</td>
                            <td class="tb-none">{{$flat->bed}}</td>
                            <td class="tb-none">{{$flat->room}}</td>
                            <td class="tb-none">{{$flat->wc}}</td>
                            <td class="tb-none">{{$flat->mq}}</td>
                            <td>
                                <img class="img-fluid" src="{{url('storage/'. $flat->image)}}" alt="{{$flat->title}}">
                            </td>
                            </div>
                            <td class="tb-none">
                                <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.flats.edit', $flat->id )}}">
                                    Modifica
                                </a>
                            </td>
                            <td>
                                <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.flats.show', $flat->id)}}">
                                    Visualizza
                                </a>
                            </td>
                            <td class="tb-none">
                                <a class="btn-blu text-decoration-none" role="button" href="{{route('admin.payments.create', $flat->id)}}">
                                    Sponsorizza
                                </a>
                            </td>
                            <td class="tb-none">{{-- elimina l'appartamento, attraverso l'id --}}
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
