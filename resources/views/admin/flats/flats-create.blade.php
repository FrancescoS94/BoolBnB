{{-- Pagina creazione appartamenti --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <h1>Aggiungi un'appartamento</h1>
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
                
                {{-- form creazione punta al Admin/controllerFlat  --}}
                <form action="{{ route('admin.flats.store')}}" method="post" enctype="multipart/form-data">
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

                    <button type="submit" class="btn btn-primary">Invia il modulo</button>
                </form>
            </div>
        </div>
    </div>
@endsection