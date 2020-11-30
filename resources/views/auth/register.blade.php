@extends('layouts.app')

@section('head')
    <script src="{{asset('js/controlli-user.js')}}"></script>
    {{-- SCRIPT DI ALGOLIA --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script> --}}
    <script src="js/algolia.js" type="text/javascript"></script>
    <style>
        #erroreRicerca{ 
            width: 6rem;
            position: relative;
            left: 42%;
            top: -20px;
            font-size: 18px;
            width: 180px !important;
            padding: 15px 13px;
            border-radius: 9px;
        }
    </style>
@endsection

@section('content')
<div class="bg-img2">
    <div class="container padd-top">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-6 py-4 mb-3 register">
                <div class="card">
                    <div class="account d-flex justify-content-center pt-4">
                        {{ __('Crea un Account') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row d-flex justify-content-center">
                                {{-- Dentro ogni "label": {{ __('Name') }} --}}
                                {{-- class di label: col-md-4 col-form-label text-md-right --}}
                                <label for="name"></label>

                                <div class="col-9">
                                    {{-- name --}}
                                    <input id="nameField" type="text" placeholder="Nome" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <span id="nameError"></span>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="lastname"></label>

                                <div class="col-9">
                                    {{-- lastname --}}
                                    <input id="lastnameField" type="text" placeholder="Cognome" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                    <span id="lastnameError"></span>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="email"></label>

                                <div class="col-9">
                                    {{-- email --}}
                                    <input id="emailField" type="email" placeholder="Indirizzo Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <span id="emailError"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="password"></label>

                                <div class="col-9">
                                    {{-- password --}}
                                    <small style="padding-bottom: 11px" id="emailHelp" class="form-text text-muted">La password deve contenere almeno un carattere alfabetico minuscolo, uno maiuscolo, un numero e un carattere speciale. Deve essere di otto caratteri o più lunga</small>
                                    <input id="passwordField" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <span id="passwordError"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <label for="password-confirm"></label>

                                <div class="col-9">
                                    <input id="password-confirm" type="password" placeholder="Conferma Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row d-flex justify-content-center">
                                <div class="col-9 mt-4">
                                    <button id="buttonSubmit" type="submit" class="btn-blu" disabled>
                                        {{ __('Iscriviti') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-12 d-flex justify-content-center pt-4">
                            <p>Hai già un account?
                                <a href="{{ route('login') }}">Accedi</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        $(document).ready(function(){
            // variabili elementi input
            const nameField= document.getElementById('nameField');
            const lastnameField=document.getElementById('lastnameField');
            const emailField = document.getElementById('emailField');
            const passwordField = document.getElementById('passwordField');


            // bottone form
            const okButton = document.getElementById('buttonSubmit');

            // variabili di errore
            const nameError= document.getElementById('nameError');
            const lastNameError= document.getElementById('lastnameError');
            const emailError= document.getElementById('emailError');
            const passwordError= document.getElementById('passwordError');
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
        })
    </script> --}}
</div>
@endsection
