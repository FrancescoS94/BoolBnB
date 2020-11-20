{{-- {{-- PAGINA USER LOGGATO --}}
@extends('layouts.admin')
@section('content')

<style>



    #avatar-img{
        display: none;
    }

    .loader_bg{
      position: fixed;
      z-index: 999999;
      background: #ffffff;
      width: 100%;
      height: 100%;
    }

    .loader{
        border: 0 solid transparent;
        border-radius: 50%;
        width: 150px;
        height: 150px;
        position: absolute;
        top: calc(50vh - 75px);
        left: calc(50vw - 75px);
    }

    .loader:before, .loader:after{
        content: '';
        border: 1em solid #ff5733;
        border-radius: 50%;
        width: inherit;
        height: inherit;
        position: absolute;
        top: 0;
        left: 0;
        animation: loader 2s linear infinite;
        opacity: 0;
    }

    .loader::before{
        animation-delay: .5s;
    }

    @keyframes loader{
        0%{
            transform: scale(0);
            opacity: 0;
        }
        50%{
            opacity: 1;
        }
        100%{
            transform: scale(1);
            opacity: 0;
        }
    }

    .bg-white{
        background-color: #4ea9be !important;
    }

    .navbar-brand.logo,input{
        color: white !important;
    }

    /* body{
        background-image: url('../image/phone_maintenance.png');
    } */
</style>

<div class="loader_bg">
    <div class="loader">

    </div>
</div>
{{-- PROFILE --}}
<div class="container">
    <img src="{{asset('image/phone_maintenance.png')}}" alt="">
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
                       <div class="card-body">
                            <h5 class="card-title">{{$user->name}}</h5>
                            <p class="card-text">{{$user->lastname}}</p>
                            <p class="card-text">{{$user->status}}</p>
                            <p class="card-text">{{$user->email}}</p>
                            <p class="card-text">Creazione profilo {{$user->created_at}}</p>
                            <p class="card-text">Ultima modifica effettuata {{$user->updated_at}}</p>
                            <p class="card-text">Data di nascita{{$user->date_of_birth}}</p>

                              {{-- Condizione logica sulla presenza o meno di un immagine di profilo, di default c'è un immagine --}}
                              <img style="width: 100px" src="{{ !is_null(Auth::user()->avatar)  ? asset('storage/'. $user->avatar)  : 'https://cdn.onlinewebfonts.com/svg/img_181369.png' }}" alt="immagine profilo">

                             {{--  rotta show, al momento inutile, NON cancellare!
                                   <a href="{{route('admin.users.update',  $user->id)}}"><button type="button" class="btn btn-success"></button></a> --}}
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
    <script>
        setTimeout(function(){
            $('.loader_bg').fadeToggle();
            $('#avatar-img').show();
        }, 1500);
    </script>
</div>
@endsection
