@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

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

                <h1>{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Completa il tuo profilo' : 'Aggiorna il tuo profilo'}}</h1>
               
                

                @if (is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth ))
                    <form method="post" action="{{ route('admin.users.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="birthday">La tua data di nascita</label>
                            <input type="date" class="form-control" name="date_of_birth">
                        </div>
                    
                        <div class="form-group">
                            <label for="file">Inserisci una tua fotografia</label>
                            <input type="file" class="form-control-file" name="avatar">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Invia il modulo</button>
                    </form>
                @else
                    <form method="post" action="{{ route('admin.users.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    
                        <div class="form-group">
                            <label for="lastname">Cognome</label>
                            <input type="text" class="form-control-file" name="lastname">
                        </div>

                        <div class="form-group">
                            <label for="birthday">La tua data di nascita</label>
                            <input type="date" class="form-control" name="date_of_birth">
                        </div>
                    
                        <div class="form-group">
                            <label for="avatar">Inserisci una tua fotografia</label>
                            <input type="file" class="form-control-file" name="avatar">
                        </div>

                        <div class="form-group">
                            <label for="password">Modifica la tua password</label>
                            <small id="emailHelp" class="form-text text-muted">Fai attenzione a quello che metti!</small>
                            <input type="password" class="form-control-file" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Invia il modulo</button>
                    </form>
                @endif

                
            </div>
        </div>
    </div>
@endsection