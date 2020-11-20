@extends('layouts.app')
@section('content')
    <div class="container flat-show flat-title">
        <h1 class="pt-5">Titolo appartamento</h1>
        <div class="row">
            {{-- IMAGE --}}
            <div class="col-md-12 col-lg-7">
                <div class="flat-img">
                    {{-- src="{{asset('storage/'. $flat->image)}}"  alt="{{$flat->title}}" --}}
                    <img class="img-thumbnail border-0" src="https://martinaway.com/wp-content/uploads/2019/05/Airbnb-San-Francisco-1.jpg"  alt="">
                </div>
            </div>
            {{-- DESCRIPTION, FEATURES & SERVICES --}}
            <div class="col-md-12 col-lg-5">
                <div>
                    <p class="text-justify flat-descr">{{$flat->description}}</p>
                </div>
                <ul>
                    <li class="float-left bed">
                        <img src="https://www.flaticon.com/svg/static/icons/svg/2286/2286105.svg" alt="Icon Bed">
                        Letti: {{$flat->bed}}
                    </li>
                    <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/578/578059.svg" alt="Icon Room">
                        Stanze: {{$flat->room}}
                    </li>
                    <li class="float-left wc">
                        <img src="https://www.flaticon.com/svg/static/icons/svg/3030/3030330.svg" alt="Icon WC">
                        WC: {{$flat->wc}}
                    </li>
                    <li>
                        <img src="https://www.flaticon.com/svg/static/icons/svg/515/515159.svg" alt="Icon Mq">
                        Mq: {{$flat->mq}}
                    </li>
                </ul>
                <h2>Servizi</h2>
                <div class="services">
                    @foreach ($service as $service)
                        <p class="text-justify">· {{$service->service}}</p>
                    @endforeach
                </div>
            </div>
            {{-- TOMTOM & FORM --}}
            <div class="col-md-7 col-lg-6 mt-5">
                <h2>Posizione</h2>
                <ul>
                    <li>
                        <img src="{{asset('image\plans.png')}}" alt="Icon Mq">
                        Mq: {{$flat->mq}}
                    </li>
                </ul>
                <div class="">
                    {{-- INSERIRE TOMTOM --}}
                </div>
            </div>
            <div class="col-md-5 offset-lg-1 col-lg-5 jumbotron mt-5">
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
                            <textarea rows="3" name="request" type="text" class="form-control" id="request" placeholder="Invia un messaggio al proprietario">{{ old('request') }}</textarea>
                        </div>
                        <button type="submit" class="btn">Invia</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
