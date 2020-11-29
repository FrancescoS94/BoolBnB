@extends('layouts.admin')

@section('head')
    <script src="{{asset('js/controlli-user.js')}}"></script>
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
    <div class="container vh">
        <div class="row d-flex justify-content-center update">
            <div class="col-md-10 col-lg-9 jumbotron mt-5">
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

                <h2 class="font-weight-bold d-flex justify-content-center">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Completa il tuo profilo' : 'Aggiorna il tuo profilo'}}</h2>
                @if (is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth ))
                    <form method="post" action="{{ route('admin.users.update', $user->id)}}" enctype="multipart/form-data" {{--onsubmit="return validateRegistr()"--}}>
                        @csrf
                        @method('PATCH')
                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-10 col-md-10 col-lg-7">
                                <label for="birthday">
                                    Inserisci la tua data di nascita
                                </label>
                                <input type="date" max="2002-12-31" class="form-control" name="date_of_birth" id="birthday" required {{-- value="{{ old('date_of_birth') }}"--}}>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-10 col-md-10 col-lg-7">
                                <label for="avatar">
                                    Inserisci una fotografia
                                </label>
                                <input type="file" class="form-control-file" name="avatar" id="avatar" required {{-- value="{{ old('avatar')}}"--}}>{{-- non mettere old qui, ancora non esiste! Eccezione Use of undefined constant old - assumed 'old' (this will throw an Error in a future version of PHP)   --}}
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center pt-4">
                            <div class="col-10 col-md-10 col-lg-7">
                                <button type="submit" class="btn-blu">
                                    Invia
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <form id="formcheck" method="post" action="{{ route('admin.users.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        {{-- NOME & COGNOME --}}
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6">
                                <label class="name" for="name">Nome:</label>
                                <input type="text" class="form-control" name="name" id="nameField" value="{{ $user->name }}" required>
                                <span id="nameError"></span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="lastname">Cognome:</label>
                                <input type="text" class="form-control" name="lastname" id="lastnameField" value="{{ $user->lastname }}" required>
                                <span id="lastnameError"></span>
                            </div>
                        </div>
                        {{-- NASCITA & EMAIL --}}
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6">
                                <label for="birthday">Data di nascita:</label>
                                <input type="date" class="form-control" max="2002-12-31" name="date_of_birth" id="date_of_birth" value="{{ $user->date_of_birth }}" required>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="email">Inserisci una nuova email:</label>
                                <input type="email" class="form-control" name="email" id="emailField" value="{{ $user->email }}" required>
                                <span id="emailError"></span>
                            </div>
                        </div>
                        {{-- PASSWORD --}}
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6">
                                <label for="password">Modifica la tua password:</label>
                                <small id="emailHelp" class="form-text text-muted">La password deve contenere almeno un carattere alfabetico minuscolo, uno maiuscolo, un numero e un carattere speciale. Deve essere di otto caratteri o più lunga</small>
                                <input type="password" class="form-control" name="password" id="passwordField" required>
                                <span id="passwordError"></span>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="password">Conferma la modifica password:</label>
                                <input type="password" class="form-control" name="password_confirmation" autocomplete="password" required>
                            </div>
                        </div>
                        {{-- IMMAGINE --}}
                        <div class="form-group row">
                            <label class="col-12" for="avatar">Modifica la tua foto</label>
                            <img class="d-block img-thumbnail mb-2 mt-2" style="width:200px;" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }} {{ $user->lastname }}">
                            <div class="col-12">
                                <input type="file" class="form-control-file" name="avatar" id="avatar" required>
                            </div>
                        </div>
                        {{-- BUTTON --}}
                        <div class="row">
                            <div class="col-12 mt-3">
                                <button id="buttonSubmit" type="submit" class="btn-blu" disabled>Aggiorna</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
