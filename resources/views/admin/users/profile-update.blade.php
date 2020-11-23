@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-8 jumbotron">

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
                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-7">
                                <label for="birthday">Inserisci la tua data di nascita</label>
                                <input type="date" class="form-control" name="date_of_birth" id="birthday" {{-- value="{{ old('date_of_birth') }}"--}}>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            <div class="col-7">
                                <label for="avatar">Inserisci una fotografia</label>
                                <input type="file" class="form-control-file" name="avatar" id="avatar" {{-- value="{{ old('avatar')}}"--}}>{{-- non mettere old qui, ancora non esiste! Eccezione Use of undefined constant old - assumed 'old' (this will throw an Error in a future version of PHP)   --}}
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center pt-4">
                            <div class="col-7">
                                <button type="submit" class="btn-blu">Invia</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form method="post" action="{{ route('admin.users.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        {{-- aggiunto il 16-11-20, modifica email --}}
                        <div class="form-group">
                            <label for="email">Inserisci una nuova email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Cognome</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $user->lastname }}">
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
                            <small id="emailHelp" class="form-text text-muted">Fai attenzione a quello che metti!</small>
                            <input type="password" class="form-control-file" name="password">
                        </div>

                        {{-- aggiunto il 16-11-20, conferma modifica password --}}
                        <div class="form-group">
                            <label for="password">Conferma la modifica</label>
                            <input type="password" class="form-control-file" name="password_confirmation" autocomplete="password">
                        </div>

                        <button type="submit" class="btn btn-primary">Invia il modulo</button>
                    </form>
                @endif





            </div>
        </div>
        {{-- <script>
            function validateRegistr(){

	            return true;
        }

        </script> --}}
    </div>
@endsection
