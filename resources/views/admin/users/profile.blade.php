{{-- PAGINA USER LOGGATO --}}
@extends('layouts.app')
@section('content')
{{-- @dd(Auth::user()->status) --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- esito dell'operazione  --}}
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>  
            @endif

            <div class="card">
                <div class="card-body">
                   Ciao {{ Auth::user()->name }} qui puoi aggiornare il tuo profilo
                   <div class="card" style="width: 18rem;">
                    <img src="" class="card-img-top" alt="">
                    <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                      <p class="card-text">{{$user->lastname}}</p>
                      <p class="card-text">{{$user->status}}</p>
                      <p class="card-text">{{$user->email}}</p>
                      <p class="card-text">Creazione profilo {{$user->created_at}}</p>
                      <p class="card-text">Ultima modifica effettuata {{$user->updated_at}}</p>
                      <p class="card-text">Data di nascita{{$user->date_of_birth}}</p>
                      <p class="card-text">{{$user->avatar}}</p>  <!--modfica 12-11 aggiunta controllo valori null -->
                      <a href="{{route('admin.users.update',  $user->id)}}"><button type="button" class="btn btn-success"></button></a>
                    </div>
                  </div>
                </div>
                <a class="btn btn-primary" href="{{route('admin.users.edit', $user->id)}}" role="button">{{ is_null(Auth::user()->avatar) || is_null(Auth::user()->date_of_birth )  ? 'Aggiungi informazioni' : 'Modifica il tuo profilo'}}</a>

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