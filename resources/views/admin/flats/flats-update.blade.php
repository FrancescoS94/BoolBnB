@extends('layouts.admin')
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

                    {{-- passo in un input nascosto l'id dell'address, PER ESEGUIRE LA MODIFICA --}}
                    <input hidden type="text" class="form-control" name="address" value="{{ $flat->address_id }}">

                    <div class="form-group">
                        <label for="title">Nome dell'appartamento</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $flat->title }}">
                    </div>

                    <div class="form-group">
                        <label for="room">Stanze</label>
                        <input type="number" class="form-control" name="room" id="room" value="{{ $flat->room }}">
                    </div>

                    <div class="form-group">
                        <label for="bed">Letti</label>
                        <input type="number" class="form-control" name="bed" id="bed" value="{{ $flat->bed }}">
                    </div>

                    <div class="form-group">
                        <label for="wc">WC</label>
                        <input type="number" class="form-control" name="wc" id="wc" value="{{ $flat->wc }}">
                    </div>

                    <div class="form-group">
                        <label for="mq">Metri quadrati</label>
                        <input type="number" class="form-control" name="mq" id="mq" value="{{ $flat->mq }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea rows="3" type="text" class="form-control-file" name="description" id="description">{{ $flat->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Inserisci una fotografia dell'appartamento</label>
                        <input type="file" class="form-control-file" name="image" id="image" value="{{ $flat->image }}">
                    </div>

                    {{-- aggiunta servizi --}}
                    <div class="form-group">
                        @foreach ($service as $service)
                            <label for="tag">{{ $service->service }}</label>
                            <input type="checkbox" name="service[]" value="{{ $service->id }}">
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">Invia il modulo</button>
                </form>
            </div>
        </div>
    </div>
@endsection
