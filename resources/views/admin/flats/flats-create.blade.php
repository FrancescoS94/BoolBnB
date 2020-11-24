{{-- Pagina creazione appartamenti --}}
@extends('layouts.admin')
@section('content')
    <div class="container update">
        <div class="row d-flex justify-content-center">
            <div class="col-11 col-sm-10 col-md-9 col-lg-8 jumbotron my-3">
                <h2 class="d-flex justify-content-center">Appartamento</h2>

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
                    {{-- form creazione punta al Admin/controllerFlat  --}}
                    <form id="form" action="{{ route('admin.flats.store')}}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('POST')

                        {{-- passo in un input nascosto l'id dell'address --}}
                        <input hidden type="text" class="form-control" name="address" value="{{ $address->id }}">

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="title">Titolo:</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="room">Stanze:</label>
                                <input type="number" class="form-control" name="room" id="room" value="{{ old('room') }}">
                            </div>
                            <div class="col-6">
                                <label for="bed">Letti:</label>
                                <input type="number" class="form-control" name="bed" id="bed" value="{{ old('bed') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <label for="wc">WC:</label>
                                <input type="number" class="form-control" name="wc" id="wc" value="{{ old('wc') }}">
                            </div>
                            <div class="col-6">
                                <label for="mq">Metri quadrati:</label>
                                <input type="number" class="form-control" name="mq" id="mq" value="{{ old('mq') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="description">Descrizione:</label>
                                <textarea rows="3" type="text" class="form-control-file" name="description" id="description">{{ old('title') }}</textarea>
                            </div>
                        </div>

                        {{-- aggiunta servizi --}}
                        <div class="form-group">
                            @foreach ($service as $service)
                                <label for="tag">{{ $service->service }}</label>
                                <input type="checkbox" name="service[]" value="{{ $service->id }}">
                            @endforeach
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="image">Inserisci una fotografia dell'appartamento</label>
                                <input type="file" class="form-control-file" name="image" id="image"  accept="image/*" value="{{ old('image') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn-blu mt-2">Registra</button>
                    </form>
                </div>

                {{-- <div id="error" class="alert alert-danger" role="alert"></div> --}}
            </div>
        </div>


        <script>
            const form=  document.getElementById('form');
            const errorElement= document.getElementById('error')

            const title= document.getElementById('title');
            const room= document.getElementById('room');
            const bed= document.getElementById('bed');
            const wc= document.getElementById('wc');
            const mq= document.getElementById('mq');
            const description= document.getElementById('description');
            const image= document.getElementById('image');

            form.addEventListener('submit', (e) => {

                if(title.value.length < 10){
                    errorElement.innerHTML = 'titolo troppo corto';
                    e.preventDefault();
                }

                if(typeof title.value !== 'string'){
                    errorElement.innerHTML = 'formato titolo non supportato, non inserire numeri';
                    e.preventDefault();
                }








            });
        </script>
    </div>
@endsection
