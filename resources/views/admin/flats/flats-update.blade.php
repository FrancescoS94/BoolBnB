@extends('layouts.admin')
@section('content')
    <div class="container update vh">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-lg-9 jumbotron my-1">
                <h2 class="d-flex justify-content-center">Modifica</h2>

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
                <form action="{{ route('admin.flats.update', $flat->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- passo in un input nascosto l'id dell'address, PER ESEGUIRE LA MODIFICA --}}
                    <input hidden type="text" class="form-control" name="address" value="{{ $flat->address_id }}">
                    {{-- TITOLO --}}
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="title">Titolo:</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $flat->title }}">
                        </div>
                    </div>
                    {{-- STANZE & LETTI --}}
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="room">Stanze:</label>
                            <input type="number" class="form-control" name="room" id="room" value="{{ $flat->room }}">
                        </div>
                        <div class="col-6">
                            <label for="bed">Letti:</label>
                            <input type="number" class="form-control" name="bed" id="bed" value="{{ $flat->bed }}">
                        </div>
                    </div>
                    {{-- WC & MQ --}}
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="wc">WC:</label>
                            <input type="number" class="form-control" name="wc" id="wc" value="{{ $flat->wc }}">
                        </div>
                        <div class="col-6">
                            <label for="mq">Metri quadrati:</label>
                            <input type="number" class="form-control" name="mq" id="mq" value="{{ $flat->mq }}">
                        </div>
                    </div>
                    {{-- DESCRIZIONE --}}
                    <div class="form-group">
                        <label for="description">Descrizione:</label>
                        <textarea rows="3" type="text" class="form-control" name="description" id="description">{{ $flat->description }}</textarea>
                    </div>
                    {{-- SERVIZI --}}
                    <div class="form-group">
                        @foreach ($service as $service)
                            <label for="tag">{{ $service->service }}</label>
                            <input type="checkbox" name="service[]" value="{{ $service->id }}">
                        @endforeach
                    </div>
                    {{-- IMMAGINE --}}
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="image">Inserisci una fotografia dell'appartamento:</label>
                            <input type="file" class="form-control-file" name="image" id="image" value="{{ $flat->image }}">
                        </div>
                    </div>
                    {{-- BUTTON --}}
                    <div class="row">
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn-blu">Invia</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
