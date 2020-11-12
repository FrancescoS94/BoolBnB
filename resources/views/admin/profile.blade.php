
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
                      <p class="card-text">{{$user->avatar}}</p>  <!--modfica 12-11 aggiunta controllo valori null -->
                    <button type="button" class="btn btn-success">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Completa il tuo profilo' : 'Modifica il tuo profilo'}}</button>
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
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script>
     $("#fade").modal({
        fadeDuration: 100
    });
</script>


@endsection