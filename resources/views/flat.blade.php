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
            <div class="offset-md-1 col-md-6 offset-lg-1 col-lg-5">
                @foreach ($service as $service)
                    <p class="text-justify">{{$service->service}}</p>
                @endforeach
                <ul>
                    <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="">
                        Letti: {{$flat->bed}}
                    </li>
                    <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="">
                        Stanze: {{$flat->room}}
                    </li>
                    <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="">
                        Bagni: {{$flat->wc}}
                    </li>
                    <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="">
                        Mq: {{$flat->mq}}
                    </li>
                </ul>
            </div>
            {{-- TOMTOM & FORM --}}
            <div class="col-md-7 col-lg-6 padd">
                <h2>Posizione</h2>
                <p>INSERIRE LA CITTA'</p>
                <div class="">
                    {{-- INSERIRE TOMTOM --}}
                </div>
            </div>
            <div class="col-md-5 col-lg-6 padd">
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
