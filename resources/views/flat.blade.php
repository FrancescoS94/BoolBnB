@extends('layouts.app')
@section('content')
    <div class="container flat-show">
        <div class="row flat-title">
            <h1>Titolo appartamento</h1>
            {{-- IMAGE --}}
            <div class="col-12">
                <div class="flat-img">
                    {{-- src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}" --}}
                    <img class="img-thumbnail border-0" src="https://www.triesteallnews.it/wp-content/images/2019/08/affitti-brevi-appartamenti.jpg"  alt="">
                </div>
            </div>
            {{-- DESCRIPTION & SERVICES --}}
            <div class="col-md-6 col-lg-6">
                <p class="text-justify flat-descr">{{$flat->description}}</p>
            </div>
            <div class="offset-md-1 col-md-5 offset-lg-1 col-lg-5">
                <ul>
                    <li>
                        <img src="{{asset('images\bed.png')}}" alt="Icon Bed">
                        Letti: {{$flat->bed}}
                    </li>
                    <li>
                        <img src="{{asset('images\room.png')}}" alt="Icon Room">
                        Stanze: {{$flat->room}}
                    </li>
                    <li>
                        <img src="{{asset('images\bath.png')}}" alt="Icon WC">
                        WC: {{$flat->wc}}
                    </li>
                    <li>
                        <img src="{{asset('images\plans.png')}}" alt="Icon Mq">
                        Mq: {{$flat->mq}}
                    </li>
                </ul>
            </div>
            {{-- SERVICES --}}
            <div class="col-7">
                <h2>Servizi</h2>
                @foreach ($service as $service)
                    <p class="text-justify">{{$service->service}}</p>
                @endforeach
            </div>
            {{-- TOMTOM & FORM --}}
            <div class="col-md-7 col-lg-6 padd">
                <h2>Posizione</h2>
                <p>INSERIRE LA CITTA'</p>
                <div class="">
                    {{-- INSERIRE TOMTOM --}}
                </div>
            </div>
            <div class="col-md-5 offset-lg-1 col-lg-5 padd">
                <div id="form-messaggio">
                    <h2>Contatta l'host</h2>
                    {{-- STATUS --}}
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- CONTROLLO ERRORI --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{-- FORM --}}
                    <form action="{{ route('messages.store') }}" method="post">
                        @csrf
                        @method('POST')
                        {{-- PASSO L'ID DEL FLAT IN UN INPUT NASCOSTO --}}
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
                        <button type="submit" class="btn">Invia</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
