
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                   Ciao {{ Auth::user()->name }} qui puoi aggiornare il tuo profilo
                   <div class="card" style="width: 18rem;">
                    <img src="" class="card-img-top" alt="">
                    <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                      <p class="card-text">{{$user->lastname}}</p>
                      <p class="card-text">{{$user->email}}</p>
                      <p class="card-text">Creazione profilo {{$user->created_at}}</p>
                      <p class="card-text">Ultima modifica effettuata {{$user->updated_at}}</p>
                      <p class="card-text">Data di nascita{{$user->date_of_birth}}</p>
                      <p class="card-text">{{$user->avatar}}</p>
                      <button type="button" class="btn btn-success">Completa il tuo profilo</button>
                    </div>
                  </div>
                </div>


                <form method="post" action="{{ route('admin.users.update', $user->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="birthday">Email address</label>
                        <input type="date" class="form-control" name="date_of_birth">
                    </div>

                    <div class="form-group">
                      <label for="file">Inserisci una tua fotografia</label>
                      <input type="file" class="form-control-file" name="avatar">
                    </div>

                    <button type="submit" class="btn btn-primary">Invia il modulo</button>
                </form>

            
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancella il tuo profilo</button>
                </form>
            
            </div>

        
        </div>

        
        
        
    </div>
</div>

@endsection