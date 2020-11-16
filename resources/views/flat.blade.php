@extends('layouts.app')
@section('content')
    <div class="container">
        pagina show Singolo appartamento visualizzato dopo la ricerca guest
        
        <h1>{{$flat->title}}</h1>
        <img style="width:250px" src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}" class="img-thumbnail">
        <p class="text-justify">{{$flat->description}}</p>
        @foreach ($service as $service)
            <p class="text-justify">{{$service->service}}</p>
        @endforeach
        <ul>
            <li>Letti: {{$flat->bed}}</li>
            <li>Stanze: {{$flat->room}}</li>
            <li>Bagni: {{$flat->wc}}</li>
            <li>Metri quadrati: {{$flat->mq}}</li>
        </ul>

        <div id="form-messaggio">
    
            <h2>Manda un messaggio al proprietario di questo appartamento</h2>
            
            {{-- status --}}
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {{-- controllo errori --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('messages.store') }}" method="post">

                @csrf
                @method('POST')

                {{-- passo l'id del flat in un input nascosto --}}
                <input hidden type="text" name="flat" class="form-control" value="{{ $flat->id }}">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nome</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">Cognome</label>
                        <input name="lastname" type="text" class="form-control" id="lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="mail" class="form-control" id="email" placeholder="Inserisci la tua email">
                </div>
                <div class="form-group">
                    <label for="request">Messaggio</label>
                    <textarea name="request" type="text" class="form-control" id="request" placeholder="Invia un messaggio al proprietario"></textarea>
                </div>
    
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
    
        </div>

    </div>
@endsection
