{{-- Pagina creazione appartamenti --}}
@extends('layouts.admin')

@section('head')
    {{-- SCRIPT CONTROLLI FLAT CREATE IN JS --}}
    <script src="{{asset('js/controlli-flat-create.js')}}"></script>
@endsection

@section('aside')
    {{-- Sidebar --}}
      <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2 aside">

        {{-- Nome e immagine Avatar --}}
        <div class="utente-dash text-center">
          <div class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              @if(Auth::check())
                  <img id="avatar-img" class="rounded-circle" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. Auth::user()->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo">
                  <p id="name"> {{Auth::user()->name}}</p>
              @endif
          </div>
        </div>

        {{-- Link Sidebar--}}
        <div class="links-box">
            <a href="{{ route('home') }}"> <span><i class="fas fa-home"></i></span><span class="link-name">Homepage</span></a>
            <a href="{{ route('admin.users.index') }}"> <span><i class="fas fa-users-cog"></i></span><span class="link-name">Profilo</span></a>
            <a href="{{ route('admin.flats.index') }}"><span><i class="fas fa-house-user"></i></span><span class="link-name">Appartamenti</span></a>
            <a href="{{ route('admin.messages.index') }}"> <span><i class="fas fa-envelope"></i></span><span class="link-name">Messaggi</span></a>
            <a href="{{ route('admin.payments.index') }}"> <span><i class="fas fa-credit-card"></i></span><span class="link-name">Pagamenti</span></a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <span><i class="fas fa-sign-out-alt"></i></span>
              <span class="link-name ">Logout</span>
            </a>
            {{-- chiamata post --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
      </div>
@endsection

@section('content')
    <div class="container update">
        <div class="row d-flex justify-content-center">
            <div class="col-11 col-sm-10 col-md-9 col-lg-8 jumbotron my-3">
                <h2 class="font-weight-bold d-flex justify-content-center">Appartamento</h2>

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
                                <textarea rows="3" type="text" class="form-control" name="description" id="description">{{ old('title') }}</textarea>
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
            </div>
        </div>
    </div>
@endsection
