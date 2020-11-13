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
                <h2>Dove si trova l'appartamento che vuoi inserire?</h2>
                {{-- form creazione indirizzo, punta al controller Admin/AddressController  --}}
                <form action="{{ route('admin.addresses.store') }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="country">Nazione</label>
                        <input type="text" class="form-control" name="country" id="country">
                    </div>

                    <div class="form-group">
                        <label for="city">Città</label>
                        <input type="text" class="form-control" name="city" id="city">
                    </div>

                    <div class="form-group">
                        <label for="address">Indirizzo</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    
                    <div class="form-group">
                        <label for="cap">CAP</label>
                        <input type="text" class="form-control" name="cap" id="cap">
                    </div>
                    
                    <div class="form-group">
                        <label for="district">Provincia</label>
                        <input type="text" class="form-control" name="district" id="district">
                    </div>
           
                    <button type="submit" class="btn btn-primary">Registra l'indirizzo dell'appartamento</button>
                </form>
                
                <h2>Descrivi il tuo appartamento a i nostri utenti</h2>
    
                {{-- form creazione punta al Admin/controllerFlat  --}}
                <form action="{{ route('admin.flats.store')" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
    
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
@endsection