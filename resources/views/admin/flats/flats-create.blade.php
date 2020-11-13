{{-- Pagina creazione appartamenti --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Aggiungi un'appartamento</h1>

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
                
                <div>
                    <h2>Descrivi il tuo appartamento a i nostri utenti</h2>
                    
                    {{-- form creazione punta al Admin/controllerFlat  --}}
                    <form action="{{ route('admin.flats.store')}}" method="post" enctype="multipart/form-data">
                    {{-- <form action="{{ route('admin.flats.store', $address['id'])}}" method="post" enctype="multipart/form-data"> --}}
                        @csrf
                        @method('POST')

                        {{-- passo in un input nascosto l'id dell'address --}}
                        <input hidden type="text" class="form-control" name="address" value="{{ $address->id }}"> 
        
                        <div class="form-group">
                            <label for="title">Titolo</label>
                            <input type="text" class="form-control" name="title">
                        </div>
    
                        <div class="form-group">
                            <label for="room">Stanze</label>
                            <input type="text" class="form-control" name="room">
                        </div>
    
                        <div class="form-group">
                            <label for="bed">Letti</label>
                            <input type="text" class="form-control" name="bed">
                        </div>
    
                        <div class="form-group">
                            <label for="wc">WC</label>
                            <input type="text" class="form-control" name="wc">
                        </div>
    
                        <div class="form-group">
                            <label for="mq">Metri quadrati</label>
                            <input type="text" class="form-control" name="mq">
                        </div>
    
                        <div class="form-group">
                            <label for="description">Descrizione</label>
                            <input type="text" class="form-control-file" name="description" >
                        </div>
    
                        <div class="form-group">
                            <label for="image">Inserisci una fotografia dell'appartamento</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
    
                        <button type="submit" class="btn btn-primary">Registra l'appartamento</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection