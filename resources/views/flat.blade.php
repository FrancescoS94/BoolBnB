@extends('layouts.app')
@section('content')
    <div class="container">
        pagina show Singolo appartamento visualizzato dopo la ricerca guest
    
        <div id="form-messaggio">
    
            <h2>Manda un messaggio al proprietario di questo appartamento</h2>
    
            <form>
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
    
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
    
        </div>

    </div>
@endsection
