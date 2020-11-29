@extends('layouts.admin')

@section('head')
    <style>
        main{
            /* height: 120vh;
            padding-top: 35px; */
        }
    </style>
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

                <h2 class="d-flex justify-content-center">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Completa il tuo profilo' : 'Aggiorna il tuo profilo'}}</h2>
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
                            <div class="col-6">
                                <label class="name" for="name">Nome:</label>
                                <input type="text" class="form-control" name="name" id="nameField" value="{{ $user->name }}" required> 
                                <span id="nameError"></span>
                            </div>
                            <div class="col-6">
                                <label for="lastname">Cognome:</label>
                                <input type="text" class="form-control" name="lastname" id="lastnameField" value="{{ $user->lastname }}" required>
                                <span id="lastnameError"></span>
                            </div>
                        </div>
                        {{-- NASCITA & EMAIL --}}
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="birthday">Data di nascita:</label>
                                <input type="date" class="form-control" max="2002-12-31" name="date_of_birth" id="date_of_birth" value="{{ $user->date_of_birth }}" required>
                            </div>
                            <div class="col-6">
                                <label for="email">Inserisci una nuova email:</label>
                                <input type="email" class="form-control" name="email" id="emailField" value="{{ $user->email }}" required>
                                <span id="emailError"></span>
                            </div>
                        </div>
                        {{-- PASSWORD --}}
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="password">Modifica la tua password:</label>
                                <small id="emailHelp" class="form-text text-muted">La password deve contenere almeno un carattere alfabetico minuscolo, uno maiuscolo, un numero e un carattere speciale. Deve essere di otto caratteri o più lunga</small>
                                <input type="password" class="form-control" name="password" id="passwordField" required>
                                <span id="passwordError"></span>
                            </div>
                            <div class="col-6">
                                <label for="password">Conferma la modifica password:</label>
                                <input type="password" class="form-control" name="password_confirmation" autocomplete="password" required>
                            </div>
                        </div>
                        {{-- IMMAGINE --}}
                        <div class="form-group row">
                            <label class="col-12" for="avatar">Inserisci una tua fotografia:</label>
                            <div class="col-12">
                                <input type="file" class="form-control-file" name="avatar" id="avatar" value="{{ $user->avatar }}" required>
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

        <script>


        // variabili elementi input
        const emailField = document.getElementById('emailField');
        const passwordField = document.getElementById('passwordField');
        const nameField= document.getElementById('nameField');       
        const lastnameField=document.getElementById('lastnameField');

        // bottone form
        const okButton = document.getElementById('buttonSubmit');

        // variabili di errore
        const emailError= document.getElementById('emailError');
        const passwordError= document.getElementById('passwordError');
        const nameError= document.getElementById('nameError');
        const lastNameError= document.getElementById('lastnameError');

        // check email
        emailField.addEventListener('keyup', function (event) {
        isValidEmail = emailField.checkValidity();
  
            if(isValidEmail){
                okButton.disabled = false;
            }else{
                emailError.innerHTML = 'inserisci un email valida, altrimenti non passi';
                okButton.disabled = true;
            }
        });

        // check email
        passwordField.addEventListener('keyup', function (event) {

         const strongRegex = RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        
            if(strongRegex.test(passwordField.value)){
                okButton.disabled = false;
            }else{
                passwordError.innerHTML = 'inserisci un password sicura, rispetta le indicazioni';
                okButton.disabled = true;
            }

            // mM134?@32eth5TD non cancellare!
             // spiegazione password forte
                /*  (?=.*[a-z])	La stringa deve contenere almeno 1 carattere alfabetico minuscolo
                    (?=.*[A-Z]) La stringa deve contenere almeno 1 carattere alfabetico maiuscolo
                    (?=.*[0-9])	La stringa deve contenere almeno 1 carattere numerico
                    (?=.*[!@#$%^&*])	La stringa deve contenere almeno un carattere speciale, ma stiamo sfuggendo ai caratteri RegEx riservati per evitare conflitti
                    (?=. {8,})	La stringa deve essere di otto caratteri o più lunga
                */
        });

        //check name
        nameField.addEventListener('keyup', function (event) {

            const regexName = /^[a-zA-Z ]{2,30}$/;

            if(regexName.test(nameField.value)){
                okButton.disabled = false;
            }else{
                nameError.innerHTML = 'Veramente ti chiami così? Non inserire numeri o caratteri speciali';
                okButton.disabled = true;
            }

            // spiegazione name regex
            /*  
                /^[a-zA-Z ]{2,30}$/ caratteri ammessi minuscole e maiuscole, niente numeri o caratteri speciali, lunghezza minima 2 e max 30
            */
        });


        //check lastname
        lastnameField.addEventListener('keyup', function (event) {

            const regexLastname = /^[a-zA-Z ]{2,30}$/;

            if(regexLastname.test(lastnameField.value)){
                okButton.disabled = false;
            }else{
                lastNameError.innerHTML = 'Bel cognome, ricordati di non inserire numeri o caratteri speciali';
                okButton.disabled = true;
            }
        });



        //let regexemail = RegExp("[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}");
        </script>
    </div>
@endsection
