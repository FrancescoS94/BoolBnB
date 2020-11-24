@extends('layouts.admin')

@section('head')
    <style>
        main{
            height: 120vh;
            padding-top: 35px;
        }
    </style>
@endsection


@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 jumbotron">

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

                <h1 class="d-flex justify-content-center">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Completa il tuo profilo' : 'Aggiorna il tuo profilo'}}</h1>



                @if (is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth ))
                    <form method="post" action="{{ route('admin.users.update', $user->id)}}" enctype="multipart/form-data" {{--onsubmit="return validateRegistr()"--}}>
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="birthday">Inserisci la tua data di nascita</label>
                            <input type="date" class="form-control" name="date_of_birth" id="birthday" {{-- value="{{ old('date_of_birth') }}"--}}>
                        </div>

                        <div class="form-group row">
                            <label for="avatar">Inserisci una fotografia</label>
                            <input type="file" class="form-control-file" name="avatar" id="avatar" {{-- value="{{ old('avatar')}}"--}}>{{-- non mettere old qui, ancora non esiste! Eccezione Use of undefined constant old - assumed 'old' (this will throw an Error in a future version of PHP)   --}}
                        </div>

                        <button type="submit" class="btn-blu">Invia</button>
                    </form>
                @else
                    <form id="form" method="post" action="{{ route('admin.users.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        {{-- aggiunto il 16-11-20, modifica email --}}
                        <div class="form-group">
                            <label for="email">Inserisci una nuova email</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" pattern="[a-zA-Z]+" minlength="2" id="name" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Cognome</label>
                            <input type="text" class="form-control" name="lastname" pattern="[a-zA-Z]+" minlength="2" id="lastname" value="{{ $user->lastname }}">
                        </div>

                        <div class="form-group">
                            <label for="birthday">Data di nascita</label>
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ $user->date_of_birth }}">
                        </div>

                        <div class="form-group">
                            <label for="avatar">Inserisci una tua fotografia</label>
                            <input type="file" class="form-control-file" name="avatar" id="avatar" value="{{ $user->avatar }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Modifica la tua password</label>
                            <small id="emailHelp" class="form-text text-muted">La password deve contenere almeno otto caratteri, minimo una maiuscola, una lettera minuscola, un numero ed un carattere speciale</small>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>

                        {{-- aggiunto il 16-11-20, conferma modifica password --}}
                        <div class="form-group">
                            <label for="password">Conferma la modifica</label>
                            <input type="password" class="form-control" name="password_confirmation" autocomplete="password"  id="password_confirm">
                        </div>

                        <button type="submit" class="btn btn-primary">Invia il modulo</button>
                    </form>
                @endif

                <div id="error" class="alert alert-danger" role="alert"></div>
            </div>
        </div>

        <script>

            const email= document.getElementById('email');
            const name= document.getElementById('name');
            const lastname= document.getElementById('lastname');
            const date_of_birth= document.getElementById('date_of_birth');
            const avatar= document.getElementById('avatar');
            const passwrod= document.getElementById('password');
            const password_confirm= document.getElementById('password_confirm');

            const form = document.getElementById('form');
            const errorElement= document.getElementById('error')

            form.addEventListener('submit', (e) => {

                let regexname = RegExp("[a-zA-Z]+");
                let regexemail = RegExp("[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}");       
                let strongRegex = RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                /* let date_of_birth = RegExp("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/"); */
        
                 // controllo lunghezza nome e cognome
                 if(name.value.length < 2 ||  name.value.length > 85){
                    errorElement.innerHTML = 'il campo nome o cognome è oltre il range supportato';
                    e.preventDefault();
                 }

                 if(regexname.test(name.value) == false){
                    errorElement.innerHTML = 'errore di compilazione, non utilizzare numeri e caratteri speciali';
                    e.preventDefault();
                }

                if(passwrod.value.length < 8){
                    errorElement.innerHTML = 'password debole';
                    e.preventDefault();
                }

                // espressione password
                if(strongRegex.test(passwrod.value) == false){
                    errorElement.innerHTML = 'errore formato password';
                    e.preventDefault();
                }
                
                // espressione emal
                if(regexemail.test(email.value) == false){
                    errorElement.innerHTML = 'errore formato email';
                    e.preventDefault();
                }

                // espressione data di nascita
                /* if(date_of_birth.test(date_of_birth.value) == false){
                    errorElement.innerHTML = 'errore formato data di nascita';
                    e.preventDefault();
                } */


                // spiegazione nome
                // accetta caratteri minuscoli e maiuscoli, no numeri iniziali

               // mM134?@32eth5TD non cancellare!

                // spiegazione password forte
                /*  (?=.*[a-z])	La stringa deve contenere almeno 1 carattere alfabetico minuscolo
                    (?=.*[A-Z]) La stringa deve contenere almeno 1 carattere alfabetico maiuscolo
                    (?=.*[0-9])	La stringa deve contenere almeno 1 carattere numerico
                    (?=.*[!@#$%^&*])	La stringa deve contenere almeno un carattere speciale, ma stiamo sfuggendo ai caratteri RegEx riservati per evitare conflitti
                    (?=. {8,})	La stringa deve essere di otto caratteri o più lunga
                */

                // spiegazione email
                /*
                    In sostanza questa espressione regolare verifica che prima della chiocciola ci sia un blocco di caratteri alfanumerici (con l’aggiunta eventuale di “.”, “+”, “_” e “-“), 
                    che dopo di essa invece ci sia almeno un blocco di caratteri alfanumerici (più “_” e  “-“),  separati da un “.”, ed infine un’estensione di almeno due lettere.
                */

                

            });
        </script>
    </div>
@endsection
