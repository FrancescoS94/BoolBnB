@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

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




                {{-- per ciascun appartamento posso modificare i valori grazie all'id --}}
                <div>Modifica appartamento</div>
                <form action="{{ route('admin.flats.update', $flat->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="room">Stanze</label>
                        <input type="text" class="form-control" name="room" value="{{ old('room') }}">
                    </div>

                    <div class="form-group">
                        <label for="bed">Letti</label>
                        <input type="text" class="form-control" name="bed" value="{{ old('bed') }}">
                    </div>

                    <div class="form-group">
                        <label for="wc">WC</label>
                        <input type="text" class="form-control" name="wc" value="{{ old('wc') }}">
                    </div>

                    <div class="form-group">
                        <label for="mq">Metri quadrati</label>
                        <input type="text" class="form-control" name="mq" value="{{ old('mq') }}">
                    </div>

                    <div class="form-group">
                    <label for="description">Descrizione</label>
                    <input type="text" class="form-control-file" name="description" value="{{ old('description') }}">
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