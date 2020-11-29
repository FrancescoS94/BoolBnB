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
                            <input type="text" class="form-control" name="title" id="titleField" value="{{ $flat->title }}" required>
                            <span id="titleError"></span>
                        </div>
                    </div>
                    {{-- STANZE & LETTI --}}
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="room">Stanze:</label>
                            <input type="number" class="form-control" name="room" id="roomField" value="{{ $flat->room }}" required>
                            <span id="roomError"></span>
                        </div>
                        <div class="col-6">
                            <label for="bed">Letti:</label>
                            <input type="number" class="form-control" name="bed" id="bedField" value="{{ $flat->bed }}" required>
                            <span id="bedError"></span>
                        </div>
                    </div>
                    {{-- WC & MQ --}}
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="wc">WC:</label>
                            <input type="number" class="form-control" name="wc" id="wcField" value="{{ $flat->wc }}" required>
                            <span id="wcError"></span>
                        </div>
                        <div class="col-6">
                            <label for="mq">Metri quadrati:</label>
                            <input type="number" class="form-control" name="mq" id="mqField" value="{{ $flat->mq }}" required>
                            <span id="mqError"></span>
                        </div>
                    </div>
                    {{-- DESCRIZIONE --}}
                    <div class="form-group">
                        <label for="description">Descrizione:</label>
                        <textarea rows="3" type="text" class="form-control" name="description" id="description" required>{{ $flat->description }}</textarea>
                    </div>
                    {{-- SERVIZI --}}
                    <div class="form-group">
                        @foreach ($service as $service)
                            <label for="tag">{{ $service->service }}</label>
                            <input type="checkbox" name="service[]" value="{{ $service->id }}" required {{(!empty($flat->id) && $flat->services->contains($service->id)) ? 'checked' : '' }}>
                        @endforeach
                    </div>
                    {{-- IMMAGINE --}}
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="image">Modifica la fotografia dell'appartamento:</label>
                            <img class="d-block img-thumbnail mb-2 mt-2" style="width:200px;" src="{{ asset('storage/' . $flat->image) }}" alt="{{ $flat->title }}" required>
                            <input type="file" class="form-control-file" name="image" id="image">
                        </div>
                    </div>
                    {{-- BUTTON --}}
                    <div class="row">
                        <div class="col-12 mt-3">
                            <button id="buttonSubmit" type="submit" class="btn-blu">Invia</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
